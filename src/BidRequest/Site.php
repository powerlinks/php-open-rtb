<?php
/**
 * Site.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 15:07
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Site implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @recommended
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Values allow: i.e. 'mysite.foo.com'
     * @var string
     */
    protected $domain;

    /**
     * Array of strings
     * @var array
     */
    protected $cat;

    /**
     * Array of strings
     * @var array
     */
    protected $sectioncat;

    /**
     * Array of strings
     * @var array
     */
    protected $pagecat;

    /**
     * @var string
     */
    protected $page;

    /**
     * @var string
     */
    protected $ref;

    /**
     * @var string
     */
    protected $search;

    /**
     * @var int
     */
    protected $mobile;

    /**
     * Values allow: 0 = no, 1 = yes
     * @var int
     */
    protected $privacypolicy;

    /**
     * @var Publisher
     */
    protected $publisher;

    /**
     * @var Content
     */
    protected $content;

    /**
     * @var string
     */
    protected $keywords;

    /**
     * @var Ext
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
     */
    public function setId($id)
    {
        $this->validateString($id);
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
     */
    public function setName($name)
    {
        $this->validateString($name);
        $this->name = $name;
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
     */
    public function setDomain($domain)
    {
        $this->validateString($domain);
        $this->domain = $domain;
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
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCat($cat)
    {
        $this->validateString($cat);
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
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addSectioncat($sectioncat)
    {
        $this->validateString($sectioncat);
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
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addPagecat($pagecat)
    {
        $this->validateString($pagecat);
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
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->validateString($page);
        $this->page = $page;
        return $this;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param $ref
     * @return $this
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param string $search
     * @return $this
     */
    public function setSearch($search)
    {
        $this->validateString($search);
        $this->search = $search;
        return $this;
    }

    /**
     * @return int
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param int $mobile
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMobile($mobile)
    {
        $this->validateIn($mobile, BitType::getAll());
        $this->mobile = $mobile;
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
     * @param $privacypolicy
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPrivacypolicy($privacypolicy)
    {
        $this->validateIn($privacypolicy, BitType::getAll());
        $this->privacypolicy = $privacypolicy;
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
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setKeywords($keywords)
    {
        $this->validateString($keywords);
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return Ext
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param Ext $ext
     * @return $this
     */
    public function setExt(Ext $ext)
    {
        $this->ext = $ext;
        return $this;
    }
}