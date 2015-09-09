<?php
/**
 * ImageMimeType.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 10:30
 */

namespace PowerLinks\OpenRtb\NativeAdRequest\Specification;


use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class ImageMimeType
{
    use GetConstants;

    const BMP = 'image/bmp';
    const X_WINDOWS_BMP = 'image/x-windows-bmp';
    const GIF = 'image/gif';
    const X_ICON = 'image/x-icon';
    const JPEG = 'image/jpeg';
    const X_PORTABLE_BITMAP = 'image/x-portable-bitmap';
    const PNG = 'image/png';
    const X_QUICKTIME = 'image/x-quicktime';
    const TIFF = 'image/tiff';
    const X_TIFF = 'image/x-tiff';
}