<?php
/**
 * Video.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 17:18
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Specification\AdPosition;
use PowerLinks\OpenRtb\BidRequest\Specification\ApiFrameworks;
use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\BidRequest\Specification\ContentDeliveryMethods;
use PowerLinks\OpenRtb\BidRequest\Specification\CreativeAttributes;
use PowerLinks\OpenRtb\BidRequest\Specification\VastCompanionTypes;
use PowerLinks\OpenRtb\BidRequest\Specification\VideoBidResponseProtocols;
use PowerLinks\OpenRtb\BidRequest\Specification\VideoLinearity;
use PowerLinks\OpenRtb\BidRequest\Specification\VideoMimeType;
use PowerLinks\OpenRtb\BidRequest\Specification\VideoPlaybackMethods;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;
use PowerLinks\OpenRtb\Tools\Classes\ArrayCollection;

class Video implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Array of strings
     * @required
     * @var array
     */
    protected $mimes;

    /**
     * Minimum video ad duration in seconds
     * @recommended
     * @var int
     */
    protected $minduration;

    /**
     * Maximum video ad duration in seconds
     * @recommended
     * @var int
     */
    protected $maxduration;

    /**
     * NOTE: Use of $protocols instead is highly recommended.
     * @deprecated
     * @var int
     */
    protected $protocol;

    /**
     * Array of integers (VideoBidResponseProtocols)
     * @recommended
     * @var array
     */
    protected $protocols;

    /**
     * Width of the video player in pixels
     * @recommended
     * @var int
     */
    protected $w;

    /**
     * Height of the video player in pixels
     * @recommended
     * @var int
     */
    protected $h;

    /**
     * > 0 Mid-Roll (value indicates start delay in second)
     * 0 Pre-Roll
     * -1 Generic Mid-Roll
     * -2 Generic Post-Roll
     * @recommended
     * @var int
     */
    protected $startdelay;

    /**
     * Indicates if the impression must be linear, nonlinear (VideoLinearity)
     * @var int
     */
    protected $linearity;

    /**
     * @var int
     */
    protected $sequence;

    /**
     * Blocked creative attributes
     * Array of integers (CreativeAttributes)
     * @var array
     */
    protected $battr;

    /**
     * null or 0 = extension is not allowed
     * -1 = extension is allowed, no time limit
     * > 0 = number of seconds of extended play supported beyond the maxduration value
     * @var int
     */
    protected $maxextended;

    /**
     * Minimum bit rate in Kbps
     * @var int
     */
    protected $minbitrate;

    /**
     * Maximum bit rate in Kbps
     * @var int
     */
    protected $maxbitrate;

    /**
     * Indicates if letter-boxing of 4:3 content into a 16:9 window is allowed, where 0 = no, 1 = yes
     * @default 1
     * @var int
     */
    protected $boxingallowed;

    /**
     * Allowed playback methods
     * Array of integers (VideoPlaybackMethods)
     * @var array
     */
    protected $playbackmethod;

    /**
     * Supported delivery methods
     * Array of integers (ContentDeliveryMethods)
     * @var array
     */
    protected $delivery;

    /**
     * AdPosition
     * @var int
     */
    protected $pos;

    /**
     * Array of Banner
     * @var ArrayCollection
     */
    protected $companionad;

    /**
     * Array of integers (ApiFrameworks)
     * @var array
     */
    protected $api;

    /**
     * Array of integers (VastCompanionTypes)
     * @var array
     */
    protected $companiontype;

    /**
     * @var int
     */
    protected $skip;

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
        $this->setCompanionad(new ArrayCollection());
    }

    /**
     * @return array
     */
    public function getMimes()
    {
        return $this->mimes;
    }

    /**
     * @param string $mimes
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addMimes($mimes)
    {
        $this->validateIn($mimes, VideoMimeType::getAll());
        $this->mimes[] = $mimes;
        return $this;
    }

    /**
     * @param array $mimes
     * @return $this
     */
    public function setMimes(array $mimes)
    {
        $this->mimes = $mimes;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinduration()
    {
        return $this->minduration;
    }

    /**
     * @param int $minduration
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMinduration($minduration)
    {
        $this->minduration = $this->validateInt($minduration);
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxduration()
    {
        return $this->maxduration;
    }

    /**
     * @param int $maxduration
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxduration($maxduration)
    {
        $this->maxduration = $this->validateInt($maxduration);
        return $this;
    }

    /**
     * @deprecated
     * @return int
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @deprecated
     * @param int $protocol
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $this->validateInt($protocol);
        return $this;
    }

    /**
     * @return array
     */
    public function getProtocols()
    {
        return $this->protocols;
    }

    /**
     * @param int $protocols
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addProtocols($protocols)
    {
        $this->validateIn($protocols, VideoBidResponseProtocols::getAll());
        $this->protocols[] = $protocols;
        return $this;
    }

    /**
     * @param array $protocols
     * @return $this
     */
    public function setProtocols(array $protocols)
    {
        $this->protocols = $protocols;
        return $this;
    }

    /**
     * @return int
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param int $w
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setW($w)
    {
        $this->w = $this->validateInt($w);
        return $this;
    }

    /**
     * @return int
     */
    public function getH()
    {
        return $this->h;
    }

    /**
     * @param int $h
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setH($h)
    {
        $this->h = $this->validateInt($h);
        return $this;
    }

    /**
     * @return int
     */
    public function getStartdelay()
    {
        return $this->startdelay;
    }

    /**
     * @param int $startdelay
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setStartdelay($startdelay)
    {
        $this->startdelay = $this->validateInt($startdelay);
        return $this;
    }

    /**
     * @return int
     */
    public function getLinearity()
    {
        return $this->linearity;
    }

    /**
     * @param int $linearity
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLinearity($linearity)
    {
        $this->validateIn($linearity, VideoLinearity::getAll());
        $this->linearity = $linearity;
        return $this;
    }

    /**
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSequence($sequence)
    {
        $this->sequence = $this->validateInt($sequence);
        return $this;
    }

    /**
     * @return array
     */
    public function getBattr()
    {
        return $this->battr;
    }

    /**
     * @param int $battr
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBattr($battr)
    {
        $this->validateIn($battr, CreativeAttributes::getAll());
        $this->battr[] = $battr;
        return $this;
    }

    /**
     * @param array $battr
     * @return $this
     */
    public function setBattr(array $battr)
    {
        $this->battr = $battr;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxextended()
    {
        return $this->maxextended;
    }

    /**
     * @param int $maxextended
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxextended($maxextended)
    {
        $this->maxextended = $this->validateInt($maxextended);
        return $this;
    }

    /**
     * @return int
     */
    public function getMinbitrate()
    {
        return $this->minbitrate;
    }

    /**
     * @param int $minbitrate
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMinbitrate($minbitrate)
    {
        $this->minbitrate = $this->validateInt($minbitrate);
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxbitrate()
    {
        return $this->maxbitrate;
    }

    /**
     * @param int $maxbitrate
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMaxbitrate($maxbitrate)
    {
        $this->maxbitrate = $this->validateInt($maxbitrate);
        return $this;
    }

    /**
     * @return int
     */
    public function getBoxingallowed()
    {
        return $this->boxingallowed;
    }

    /**
     * @param int $boxingallowed
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBoxingallowed($boxingallowed)
    {
        $this->validateIn($boxingallowed, BitType::getAll());
        $this->boxingallowed = $boxingallowed;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlaybackmethod()
    {
        return $this->playbackmethod;
    }

    /**
     * @param int $playbackmethod
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addPlaybackmethod($playbackmethod)
    {
        $this->validateIn($playbackmethod, VideoPlaybackMethods::getAll());
        $this->playbackmethod[] = $playbackmethod;
        return $this;
    }

    /**
     * @param array $playbackmethod
     * @return $this
     */
    public function setPlaybackmethod(array $playbackmethod)
    {
        $this->playbackmethod = $playbackmethod;
        return $this;
    }

    /**
     * @return array
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param int $delivery
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addDelivery($delivery)
    {
        $this->validateIn($delivery, ContentDeliveryMethods::getAll());
        $this->delivery[] = $delivery;
        return $this;
    }

    /**
     * @param array $delivery
     * @return $this
     */
    public function setDelivery(array $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return int
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @param int $pos
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPos($pos)
    {
        $this->validateIn($pos, AdPosition::getAll());
        $this->pos = $pos;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCompanionad()
    {
        return $this->companionad;
    }

    /**
     * @param Banner $companionad
     * @return $this
     */
    public function addCompanionad(Banner $companionad)
    {
        $this->companionad->add($companionad);
        return $this;
    }

    /**
     * @param ArrayCollection $companionad
     * @return $this
     */
    public function setCompanionad(ArrayCollection $companionad)
    {
        $this->companionad = $companionad;
        return $this;
    }

    /**
     * @return array
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param int $api
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addApi($api)
    {
        $this->validateIn($api, ApiFrameworks::getAll());
        $this->api[] = $api;
        return $this;
    }

    /**
     * @param array $api
     * @return $this
     */
    public function setApi(array $api)
    {
        $this->api = $api;
        return $this;
    }

    /**
     * @return array
     */
    public function getCompaniontype()
    {
        return $this->companiontype;
    }

    /**
     * @param $companiontype
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCompaniontype($companiontype)
    {
        $this->validateIn($companiontype, VastCompanionTypes::getAll());
        $this->companiontype[] = $companiontype;
        return $this;
    }

    /**
     * @param array $companiontype
     * @return $this
     */
    public function setCompaniontype(array $companiontype)
    {
        $this->companiontype = $companiontype;
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

    /**
     * @return int
     */
    public function getSkip()
    {
        return $this->skip;
    }

    /**
     * @param int $skip
     * @return $this
     */
    public function setSkip($skip)
    {
        $this->skip = $skip;
        return $this;
    }
}