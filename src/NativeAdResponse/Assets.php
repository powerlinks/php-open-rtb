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

    protected $id required int - Unique asset ID, assigned by
exchange, must match one of
the asset IDs in request
    protected $required optional int 0 Set to 1 if asset is required.
(bidder requires it to be
displayed).
    protected $title optional1 object - Title object for title assets. See
Title Object definition.
    protected $img optional1 object - Image object for image assets.
See Image Object definition.
    protected $video optional1 object - Video object for video assets.
See Video Object definition.
Note that in-stream video ads
are not part of Native. Native
ads may contain a video as the
ad creative itself.
    protected $data optional1 object - Data object for ratings, prices
etc.

    protected $link optional object - Link object for call to actions.
The link object applies if the
asset item is activated (clicked).
If there is no link object on the
asset, the parent link object on
the bid response applies.
    protected $ext

}