<?php
/**
 * Content.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 15:39
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\BidRequest\Specification\ContentContext;
use PowerLinks\OpenRtb\BidRequest\Specification\QagMediaRatings;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Content implements Arrayable
{
    use SetterValidation;
    use ToArray;
    /**
     * @var string
     */
    protected $id;

    /**
     * Episode number
     * @var int
     */
    protected $episode;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $series;

    /**
     * Content season; typically for video content (e.g., “Season 3”)
     * @var string
     */
    protected $season;

    /**
     * @var Producer
     */
    protected $producer;

    /**
     * URL of the content
     * @var string
     */
    protected $url;

    /**
     * Array of Strings
     * @var array
     */
    protected $cat;

    /**
     * @var int
     */
    protected $videoquality;

    /**
     * Type of content (game, video, text, etc.)
     * PowerLinks\OpenRtb\BidRequest\Specification\ContentContext
     * @var int
     */
    protected $context;

    /**
     * Content rating (e.g., MPAA)
     * @var string
     */
    protected $contentrating;

    /**
     * User rating of the content (e.g., number of stars, likes, etc.)
     * @var string
     */
    protected $userrating;

    /**
     * Media rating per QAG guidelines
     * PowerLinks\OpenRtb\BidRequest\Specification\QagMediaRatings
     * @var int
     */
    protected $qagmediarating;

    /**
     * Comma separated list of keywords describing the content
     * @var string
     */
    protected $keywords;

    /**
     * 0 = not live, 1 = content is live (e.g., stream, live blog)
     * @var int
     */
    protected $livestream;

    /**
     * 0 = indirect, 1 = direct
     * @var int
     */
    protected $sourcerelationship;

    /**
     * Length of content in seconds; appropriate for video or audio
     * @var int
     */
    protected $len;

    /**
     * Content language using ISO-639-1-alpha-2
     * @var string
     */
    protected $language;

    /**
     * Indicator of whether or not the content is embeddable (e.g., an embeddable video player), where 0 = no, 1 = yes
     * @var int
     */
    protected $embeddable;

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
        $this->setProducer(new Producer());
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
     * @return int
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * @param int $episode
     * @return $this
     */
    public function setEpisode($episode)
    {
        $this->episode = $this->validatePositiveInt($episode);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->validateString($title);
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param string $series
     * @return $this
     */
    public function setSeries($series)
    {
        $this->validateString($series);
        $this->series = $series;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param string $season
     * @return $this
     */
    public function setSeason($season)
    {
        $this->validateString($season);
        $this->season = $season;
        return $this;
    }

    /**
     * @return Producer
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param Producer $producer
     * @return $this
     */
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->validateString($url);
        $this->url = $url;
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
     * @return int
     */
    public function getVideoquality()
    {
        return $this->videoquality;
    }

    /**
     * @param int $videoquality
     * @return $this
     */
    public function setVideoquality($videoquality)
    {
        $this->videoquality = $this->validateInt($videoquality);
        return $this;
    }

    /**
     * @return int
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param int $context
     * @return $this
     */
    public function setContext($context)
    {
        $this->validateIn($context, ContentContext::getAll());
        $this->context = $context;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentrating()
    {
        return $this->contentrating;
    }

    /**
     * @param string $contentrating
     * @return $this
     */
    public function setContentrating($contentrating)
    {
        $this->validateString($contentrating);
        $this->contentrating = $contentrating;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserrating()
    {
        return $this->userrating;
    }

    /**
     * @param string $userrating
     * @return $this
     */
    public function setUserrating($userrating)
    {
        $this->validateString($userrating);
        $this->userrating = $userrating;
        return $this;
    }

    /**
     * @return int
     */
    public function getQagmediarating()
    {
        return $this->qagmediarating;
    }

    /**
     * @param $qagmediarating
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setQagmediarating($qagmediarating)
    {
        $this->validateIn($qagmediarating, QagMediaRatings::getAll());
        $this->qagmediarating = $qagmediarating;
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
     */
    public function setKeywords($keywords)
    {
        $this->validateString($keywords);
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return int
     */
    public function getLivestream()
    {
        return $this->livestream;
    }

    /**
     * @param int $livestream
     * @return $this
     */
    public function setLivestream($livestream)
    {
        $this->validateIn($livestream, BitType::getAll());
        $this->livestream = $livestream;
        return $this;
    }

    /**
     * @return int
     */
    public function getSourcerelationship()
    {
        return $this->sourcerelationship;
    }

    /**
     * @param int $sourcerelationship
     * @return $this
     */
    public function setSourcerelationship($sourcerelationship)
    {
        $this->validateIn($sourcerelationship, BitType::getAll());
        $this->sourcerelationship = $sourcerelationship;
        return $this;
    }

    /**
     * @return int
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * @param $len
     * @return $this
     */
    public function setLen($len)
    {
        $this->len = $this->validatePositiveInt($len);
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->validateString($language);
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmbeddable()
    {
        return $this->embeddable;
    }

    /**
     * @param int $embeddable
     * @return $this
     */
    public function setEmbeddable($embeddable)
    {
        $this->validateIn($embeddable, BitType::getAll());
        $this->embeddable = $embeddable;
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