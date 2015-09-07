<?php
/**
 * App.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 15:29
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\BidRequest\Validation\SetterValidation;
use PowerLinks\OpenRtb\BidRequest\Validation\ToArray;

class App implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @recommended
     * @var string
     */
    protected $id;

    /**
     * App name (may be aliased at the publisher’s request)
     * @var string
     */
    protected $name;

    /**
     * Application bundle or package name (e.g., com.foo.mygame)
     * @var string
     */
    protected $bundle;

    /**
     * Domain of the app (e.g., “mygame.foo.com”)
     * @var string
     */
    protected $domain;

    /**
     * App store URL for an installed app
     * @var string
     */
    protected $storeurl;

    /**
     * Array of string
     * @var array
     */
    protected $cat;

    /**
     * Array of string
     * @var array
     */
    protected $sectioncat;

    /**
     * Array of string
     * @var array
     */
    protected $pagecat;

    /**
     * Application version
     * @var string
     */
    protected $ver;

    /**
     * Indicates if the app has a privacy policy, where 0 = no, 1 = yes
     * @var int
     */
    protected $privacypolicy;

    /**
     * 0 = app is free, 1 = the app is a paid versio
     * @var int
     */
    protected $paid;

    /**
     * Details about the Publisher
     * @var Publisher
     */
    protected $publisher;

    /**
     * Details about the Content
     * @var Content
     */
    protected $content;

    /**
     * Comma separated list of keywords about the app
     * @var string
     */
    protected $keywords;

    /**
     * @var
     */
    protected $ext;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setPublisher(new Publisher());
        $this->setContent(new Content());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id, __LINE__);
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setName($name)
    {
        $this->validateString($name, __LINE__);
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * @param string $bundle
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setBundle($bundle)
    {
        $this->validateString($bundle, __LINE__);
        $this->bundle = $bundle;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setDomain($domain)
    {
        $this->validateString($domain, __LINE__);
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getStoreurl()
    {
        return $this->storeurl;
    }

    /**
     * @param string $storeurl
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setStoreurl($storeurl)
    {
        $this->validateString($storeurl, __LINE__);
        $this->storeurl = $storeurl;
        return $this;
    }

    /**
     * @return array
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param string $cat
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function addCat($cat)
    {
        $this->validateString($cat, __LINE__);
        $this->cat[] = $cat;
        return $this;
    }

    /**
     * @param array $cat
     * @return $this
     */
    public function setCat(array $cat)
    {
        $this->cat = $cat;
        return $this;
    }

    /**
     * @return array
     */
    public function getSectioncat()
    {
        return $this->sectioncat;
    }

    /**
     * @param string $sectioncat
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function addSectioncat($sectioncat)
    {
        $this->validateString($sectioncat, __LINE__);
        $this->sectioncat[] = $sectioncat;
        return $this;
    }

    /**
     * @param array $sectioncat
     * @return $this
     */
    public function setSectioncat(array $sectioncat)
    {
        $this->sectioncat = $sectioncat;
        return $this;
    }

    /**
     * @return array
     */
    public function getPagecat()
    {
        return $this->pagecat;
    }

    /**
     * @param string $pagecat
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function addPagecat($pagecat)
    {
        $this->validateString($pagecat, __LINE__);
        $this->pagecat[] = $pagecat;
        return $this;
    }

    /**
     * @param array $pagecat
     * @return $this
     */
    public function setPagecat(array $pagecat)
    {
        $this->pagecat = $pagecat;
        return $this;
    }

    /**
     * @return string
     */
    public function getVer()
    {
        return $this->ver;
    }

    /**
     * @param string $ver
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setVer($ver)
    {
        $this->validateString($ver, __LINE__);
        $this->ver = $ver;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrivacypolicy()
    {
        return $this->privacypolicy;
    }

    /**
     * @param int $privacypolicy
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setPrivacypolicy($privacypolicy)
    {
        $this->validateIn($privacypolicy, BitType::getAll(), __LINE__);
        $this->privacypolicy = $privacypolicy;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @param int $paid
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setPaid($paid)
    {
        $this->validateIn($paid, BitType::getAll(), __LINE__);
        $this->paid = $paid;
        return $this;
    }

    /**
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param Publisher $publisher
     * @return $this
     */
    public function setPublisher(Publisher $publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Content $content
     * @return $this
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setKeywords($keywords)
    {
        $this->validateString($keywords, __LINE__);
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param mixed $ext
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
    }


}