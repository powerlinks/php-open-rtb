<?php
/**
 * Assets.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 14:34
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Assets implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Unique asset ID, assigned by exchange, must match one of the asset IDs in request
     * @required
     * @var int
     */
    protected $id ;

    /**
     * Set to 1 if asset is required
     * @default 0
     * @var int
     */
    protected $required;

    /**
     * Title object for title assets
     * @var Title
     */
    protected $title;

    /**
     * Image object for image assets
     * @var Image
     */
    protected $img;

    /**
     * Video object for video assets
     * @var Video
     */
    protected $video;

    /**
     * Data object for ratings, prices etc
     * @var Data
     */
    protected $data;

    /**
     * Link object for call to actions
     * @var Link
     */
    protected $link;

    /**
     * @var Ext
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
        $this->id = $this->validateInt($id, __LINE__);
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
        $this->required = $this->validateInt($required, __LINE__);
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
     * @return Link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param Link $link
     * @return $this
     */
    public function setLink(Link $link)
    {
        $this->link = $link;
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