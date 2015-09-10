<?php
/**
 * Assets.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 08/09/15 - 10:12
 */

namespace PowerLinks\OpenRtb\NativeAdRequest;

use PowerLinks\OpenRtb\NativeAdRequest\Specification\BitType;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Assets implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Unique asset ID, assigned by exchange
     * @required
     * @var int
     */
    protected $id;

    /**
     * Set to 1 if asset is required
     * @default 0
     * @var int
     */
    protected $required;

    /**
     * @var Title
     */
    protected $title;

    /**
     * @var Image
     */
    protected $img;

    /**
     * @var Video
     */
    protected $video;

    /**
     * @var Data
     */
    protected $data;

    /**
     * @var
     */
    protected $ext;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateInt($id, __LINE__);
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param int $required
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setRequired($required)
    {
        $this->validateIn($required, BitType::getAll(), __LINE__);
        $this->required = $required;
        return $this;
    }

    /**
     * @return Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param Title $title
     * @return $this
     */
    public function setTitle(Title $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return Image
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param Image $img
     * @return $this
     */
    public function setImg(Image $img)
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return $this
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return Data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param Data $data
     * @return $this
     */
    public function setData(Data $data)
    {
        $this->data = $data;
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