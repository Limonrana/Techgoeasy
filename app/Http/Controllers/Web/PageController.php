<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Rules\Recaptcha;
use App\Services\Web\HomeBlogServices;
use App\Services\Web\SingleBlogServices;
use App\Services\Web\TaxonomyServices;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    use SEOToolsTrait;

    /**
     * @var $homeBlogServices
     */
    protected HomeBlogServices $homeBlogServices;

    /**
     * Create a new Blog Services instance.
     *
     * @param HomeBlogServices $homeBlogServices
     * @return void
     */
    public function __construct(HomeBlogServices $homeBlogServices)
    {
        $this->homeBlogServices = $homeBlogServices;
    }


    /**
     * Display the home page resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        // Load SEO Details
        $settings = getSetting('general');
        $this->seo()->setTitle($settings && $settings->has('site_title') ? $settings['site_title'] : config('app.name'))
            ->metatags()->setKeywords($settings && $settings->has('meta_keywords') ? $settings['meta_keywords'] : ['blog'])
            ->addMeta('title', $settings && $settings->has('site_title') ? $settings['site_title'] : config('app.name'))
            ->setDescription($settings && $settings->has('tagline') ? $settings['tagline'] : 'Our blog website');
        // Database Query
        $featuredRecentPosts = $this->homeBlogServices->getRecentPost()->takeRange(2);
        $recentPosts = $this->homeBlogServices->getRecentPost()->takeFromRange(2);
        $categoriesPost = $this->homeBlogServices->getPostCategoryBased();
        $featuredPosts = $this->homeBlogServices->getFeaturedPost();
        $popularPosts = $this->homeBlogServices->getPopularPost();
        $categories = $this->homeBlogServices->getCategories();
        $tags = $this->homeBlogServices->getTags();
        // Return View
        return view('web.pages.home', compact(
            'featuredRecentPosts','categories', 'tags',
            'categoriesPost', 'featuredPosts', 'recentPosts', 'popularPosts'
        ));
    }

    /**
     * Display the single post page resource.
     *
     * @param string $slug
     * @param SingleBlogServices $singleBlogServices
     * @return \Illuminate\Contracts\View\View
     */
    public function post($slug, SingleBlogServices $singleBlogServices)
    {
        $post = $singleBlogServices->execute($slug);
        $popularPosts = $this->homeBlogServices->getPopularPost(3);
        $categories = $this->homeBlogServices->getCategories();
        $relatedPosts = $singleBlogServices->getRelatedPost();
        $category = $post->categories->first();
        $tag = $post->tags->first();
        // Load SEO Details
        $this->seo()->setTitle($post->meta_title ?? $post->title)
            ->metatags()->setKeywords($post->meta_keywords)
            ->addMeta('title', $post->meta_title ?? $post->title)
            ->addMeta('article:published_time', $post->created_at->toW3CString(), 'property')
            ->addMeta('article:modified_time', $post->updated_at->toW3CString(), 'property')
            ->addMeta('article:author', $post->createdBy->name, 'property')
            ->addMeta('article:section', $category ? $category->name : 'Uncategorized', 'property')
            ->addMeta('article:tag', $tag ? $tag->name : '', 'property')
            ->setDescription($post->meta_description);
        $this->seo()->opengraph()->setType('article')->addImage($post->featured_image);
        $this->seo()->twitter()->setDescription($post->meta_description)->setImage($post->featured_image);
        $this->seo()->jsonLdMulti()->setType('WebPage')->setUrl(URL::current())
            ->setTitle('Page Article - '.$post->meta_title)->setDescription('Page Article - '.$post->meta_description);
        $this->seo()->jsonLdMulti()->newJsonLd()->setTitle($post->meta_title)->setDescription($post->meta_description)
            ->setSite(URL::current())->addImage($post->featured_image)->setType('Article')
            ->addValue('headline', $post->meta_title)->addValue('datePublished', $post->created_at->toW3CString())
            ->addValue('dateModified', $post->updated_at->toW3CString());
        // Return View
        return view('web.pages.post', compact('post', 'popularPosts', 'categories', 'relatedPosts'));
    }

    /**
     * Display the tag post page resource.
     *
     * @param string $slug
     * @param TaxonomyServices $taxonomyServices
     * @return \Illuminate\Contracts\View\View
     */
    public function tag(string $slug, TaxonomyServices $taxonomyServices)
    {
        $settings = getSetting('general');
        $tag = $taxonomyServices->getTag($slug);
        $posts = $taxonomyServices->getPosts(10);
        $categories = $this->homeBlogServices->getCategories();
        // SEO Details
        $this->seo()->setTitle($tag->name)
            ->metatags()->setKeywords($settings && $settings->has('meta_keywords') ? $settings['meta_keywords'] : ['blog'])
            ->addMeta('title', $tag->name ?? 'My Tag')
            ->setDescription($settings && $settings->has('tagline') ? $settings['tagline'] : 'Our blog website');
        return view('web.pages.tag', compact('tag', 'posts', 'categories'));
    }

    /**
     * Display the search post page resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function search()
    {
        // Database Query
        $featuredRecentPosts = $this->homeBlogServices->getRecentPost()->takeRange(2);
        $recentPosts = $this->homeBlogServices->getRecentPost()->takeFromRange(2);
        $categoriesPost = $this->homeBlogServices->getPostCategoryBased();
        $featuredPosts = $this->homeBlogServices->getFeaturedPost();
        $popularPosts = $this->homeBlogServices->getPopularPost();
        $categories = $this->homeBlogServices->getCategories();
        $tags = $this->homeBlogServices->getTags();
        // Return View
        return view('web.pages.home', compact(
            'featuredRecentPosts','categories', 'tags',
            'categoriesPost', 'featuredPosts', 'recentPosts', 'popularPosts'
        ));
    }

    /**
     * Display the category post page resource.
     *
     * @param string $slug
     * @param TaxonomyServices $taxonomyServices
     * @return \Illuminate\Contracts\View\View
     */
    public function category(string $slug, TaxonomyServices $taxonomyServices)
    {
        $settings = getSetting('general');
        $category = $taxonomyServices->getCategory($slug);
        $posts = $taxonomyServices->getPosts(10);
        $categories = $this->homeBlogServices->getCategories();
        // SEO Details
        $this->seo()->setTitle($category->name ?? 'My Category')
            ->metatags()->setKeywords($settings && $settings->has('meta_keywords') ? $settings['meta_keywords'] : ['blog'])
            ->addMeta('title', $category->name ?? 'My Category')
            ->setDescription($settings && $settings->has('tagline') ? $settings['tagline'] : 'Our blog website');
        return view('web.pages.category', compact('category', 'posts', 'categories'));
    }

    /**
     * Check the recaptcha resource.
     *
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recaptcha(Request $request)
    {
        $validator = Validator::make(
            $request->except('_token'),
            [
                'gRecaptcha' => ['required']
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => 'Are you robot?'], 422);
        }
        return response()->json(['message' => 'Success'], 201);
    }
}
