<?php
/**
 * BidRequest.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 11:39
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Exception\ExceptionInvalidValue;
use PowerLinks\OpenRtb\BidRequest\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Validation\SetterValidation;
use PowerLinks\OpenRtb\BidRequest\Validation\ToArray;
use PowerLinks\OpenRtb\Collection\ArrayCollection;

class BidRequest implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @required
     * @var string
     */
    protected $id;

    /**
     * @required
     * @var ArrayCollection
     */
    protected $imp;

    /**
     * @recommended
     * @var Site
     */
    protected $site;

    /**
     * @recommended
     * @var App
     */
    protected $app;

    /**
     * @recommended
     * @var Device
     */
    protected $device;

    /**
     * @recommended
     * @var User
     */
    protected $user;

    /**
     * where 0 = live mode, 1 = test mode
     * @default 0
     * @var int
     */
    protected $test;

    /**
     * Auction type, where 1 = First Price, 2 = Second Price Plus
     * @default 2
     * @var int
     */
    protected $at;

    /**
     * Maximum time in milliseconds to submit a bid to avoid timeout
     * @var int
     */
    protected $tmax;

    /**
     * Array of strings
     * @var array
     */
    protected $wseat;

    /**
     * 0 = no or unknown, 1 = yes
     * @default 0
     * @var int
     */
    protected $allimps;

    /**
     * Array of strings (allowed currencies for bids on this bid request using ISO-4217 alpha codes)
     * @var array
     */
    protected $cur;

    /**
     * Array of strings
     * @var array
     */
    protected $bcat;

    /**
     * Array of strings
     * Block list of advertisers by their domains (e.g., “ford.com”)
     * @var array
     */
    protected $badv;

    /**
     * @var Regs
     */
    protected $regs;

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
        $this->setImp(new ArrayCollection());
        $this->setSite(new Site());
        $this->setApp(new App());
        $this->setDevice(new Device());
        $this->setUser(new User());
        $this->setRegs(new Regs());
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return json_encode($this->toArray());
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
     * @throws ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id, __LINE__);
        $this->id = $id;
        return $this;
    }

    /**
     * @param ArrayCollection $imp
     * @return ArrayCollection
     */
    public function setImp(ArrayCollection $imp)
    {
        $this->imp = $imp;
        return $this;
    }

    /**
     * @param Imp $imp
     * @return $this
     */
    public function addImp(Imp $imp = null)
    {
        if (is_null($imp)) {
            $imp = new Imp();
        }
        $this->imp->add($imp);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImp()
    {
        return $this->imp;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     * @return $this
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param App $app
     * @return $this
     */
    public function setApp(App $app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     * @return $this
     */
    public function setDevice(Device $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Regs
     */
    public function getRegs()
    {
        return $this->regs;
    }

    /**
     * @param Regs $regs
     * @return $this
     */
    public function setRegs(Regs $regs)
    {
        $this->regs = $regs;
        return $this;
    }

    /**
     * @return int
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param $test
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function setTest($test)
    {
        $this->validateIn($test, BitType::getAll(), __LINE__);
        $this->test = $test;
        return $this;
    }

    /**
     * @return int
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @param int $at
     * @return $this
     */
    public function setAt($at)
    {
        $this->validateInt($at, __LINE__);
        $this->at = $at;
        return $this;
    }

    /**
     * @return int
     */
    public function getTmax()
    {
        return $this->tmax;
    }

    /**
     * @param int $tmax
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function setTmax($tmax)
    {
        $this->validatePositiveInt($tmax, __LINE__);
        $this->tmax = $tmax;
        return $this;
    }

    /**
     * @return array
     */
    public function getWseat()
    {
        return $this->wseat;
    }

    /**
     * @param string $wseat
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function addWseat($wseat)
    {
        $this->validateString($wseat, __LINE__);
        $this->wseat[] = $wseat;
        return $this;
    }

    /**
     * @param array $wseat
     * @return $this
     */
    public function setWseat(array $wseat)
    {
        $this->wseat = $wseat;
        return $this;
    }

    /**
     * @return int
     */
    public function getAllimps()
    {
        return $this->allimps;
    }

    /**
     * @param int $allimps
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function setAllimps($allimps)
    {
        $this->validateIn($allimps, BitType::getAll(), __LINE__);
        $this->allimps = $allimps;
        return $this;
    }

    /**
     * @return array
     */
    public function getCur()
    {
        return $this->cur;
    }

    /**
     * @param string $cur
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function addCur($cur)
    {
        $this->validateString($cur, __LINE__);
        $this->cur[] = $cur;
        return $this;
    }

    /**
     * @param array $cur
     * @return $this
     */
    public function setCur(array $cur)
    {
        $this->cur = $cur;
        return $this;
    }

    /**
     * @return array
     */
    public function getBcat()
    {
        return $this->bcat;
    }

    /**
     * @param string $bcat
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function addBcat($bcat)
    {
        $this->validateString($bcat, __LINE__);
        $this->bcat[] = $bcat;
        return $this;
    }

    /**
     * @param array $bcat
     * @return $this
     */
    public function setBcat(array $bcat)
    {
        $this->bcat = $bcat;
        return $this;
    }

    /**
     * @return array
     */
    public function getBadv()
    {
        return $this->badv;
    }

    /**
     * @param string $badv
     * @return $this
     * @throws ExceptionInvalidValue
     */
    public function addBadv($badv)
    {
        $this->validateString($badv, __LINE__);
        $this->badv[] = $badv;
        return $this;
    }

    /**
     * @param array $badv
     * @return $this
     */
    public function setBadv(array $badv)
    {
        $this->badv = $badv;
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
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }
}