<?php
/**
 * Native.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 17:18
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\NativeAdRequest\NativeAdRequest;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\ApiFrameworks;
use PowerLinks\OpenRtb\BidRequest\Specification\CreativeAttributes;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Native implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @required
     * @var string
     */
    protected $request;

    /**
     * @recommended
     * @var string
     */
    protected $ver;

    /**
     * Array of integers (ApiFrameworks)
     * @var array
     */
    protected $api;

    /**
     * Array of integers (CreativeAttributes)
     * @var array
     */
    protected $battr;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function setRequestViaNativeAdRequest(NativeAdRequest $nativeAdRequest)
    {
        $this->setRequest($nativeAdRequest->getRequest());
    }

    /**
     * @param string $request
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setRequest($request)
    {
        $this->validateString($request);
        $this->request = $request;
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
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVer($ver)
    {
        $this->validateString($ver);
        $this->ver = $ver;
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