<?php
/**
 * HydratorTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 12:14
 */

namespace PowerLinks\OpenRtb\Tests;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\BidRequest\Banner;
use PowerLinks\OpenRtb\BidRequest\BidRequest;
use PowerLinks\OpenRtb\BidRequest\Native;
use PowerLinks\OpenRtb\Hydrator;
use PowerLinks\OpenRtb\NativeAdRequest\NativeAdRequest;

class HydratorTest extends PHPUnit_Framework_TestCase
{
    public function testHydrate()
    {
        $array = [
            'id' => 'aaa',
            'imp' => [
                ['id' => 'bbb']
            ]
        ];

        $object = new BidRequest();

        $result = Hydrator::hydrate($array, $object);

        $this->assertSame($object, $result);
        $this->assertEquals('aaa', $object->getId());
        $this->assertInstanceOf('PowerLinks\OpenRtb\Tools\Classes\ArrayCollection', $object->getImp());
        $this->assertInstanceOf('PowerLinks\OpenRtb\BidRequest\Imp', $object->getImp()->current());
        $this->assertEquals('bbb', $object->getImp()->current()->getId());
    }

    public function testHydrateBidRequest()
    {
        $json = '{"badv":[],"tmax":200,"site":{"publisher":{"id":"267","name":"disqus"},"domain":"sozcu.com.tr","page":"http:\/\/www.sozcu.com.tr\/2015\/dunya\/turkiyeden-suriyeye-yuklu-miktarda-silah-sevkiyati-912385\/","id":"3763","sectioncat":["IAB12"]},"imp":[{"tagid":"","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":300},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.48,"id":"1"}],"device":{"os":"Windows 7","ip":"212.156.124.250","osv":"","geo":{"country":"TUR"},"dnt":0,"devicetype":2,"model":"Other","ua":"Mozilla\/5.0 (Windows NT 6.1; WOW64; Trident\/7.0; rv:11.0) like Gecko"},"at":2,"test":0,"id":"9c2e6ec2-99bd-4473-b4eb-b38e1ddea6d3","user":{"id":"fe3e4791fe2335ff9e786e7ef0a108d2d3d1b216"}}';

        $object = new BidRequest();

        Hydrator::hydrate(json_decode($json, true), $object);

        $this->assertEquals(200, $object->getTmax());
        $this->assertEquals('267', $object->getSite()->getPublisher()->getId());
    }

    public function testHydrateBidRequestOk()
    {
        $json = '{"id":"[ID]","imp":[{"id":"[IMP-ID]","native":{"request":"{\"native\":{\"layout\":7,\"adunit\":2,\"plcmtcnt\":6,\"seq\":0,\"assets\":[{\"id\":1,\"title\":{\"len\":50}},{\"id\":2,\"required\":1,\"img\":{\"w\":100,\"h\":70}}]}}"},"bidfloor":0.0,"ext":{"bidmodel":"CPC"}}],"site":{"cat":["IAB3"],"page":"http://asdf.com/","keywords":"tech"},"device":{"ua":"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36","ip":"24.193.27.157"},"at":1,"ext":{"pmodel":"cpc"}}';

        $object = new BidRequest();

        Hydrator::hydrate(json_decode($json, true), $object);

        $this->assertEquals('[ID]', $object->getId());
        $this->assertEquals('cpc', $object->getExt()->get('pmodel'));
        $this->assertTrue(is_string($object->getImp()->current()->getNative()->getRequest()));

        $native = Hydrator::hydrate(json_decode($object->getImp()->current()->getNative()->getRequest(), true)['native'], new NativeAdRequest());
        $this->assertEquals($object->getImp()->current()->getNative()->getRequest(), $native->getRequest());
    }

    public function testHydrateWithExtraFakeFields()
    {
        $native = [
            'request' => '{}',
            'ver' => '1.1',
            'api' => [],
            'battr' => [],
            'ext' => [],
            // fields that don't exist
            'plcmtcnt' => 'fake',
            'assets' => 'fake',
            'adunit' => 3,
            'layout' => 'fake'
        ];
        $object = new Native();

        Hydrator::hydrate($native, $object);

        $this->assertEquals('1.1', $object->getVer());
        $this->assertEquals('{}', $object->getRequest());
    }

    /**
     * @dataProvider jsonProvider
     */
    public function testHydrateRecursive($json)
    {
        Hydrator::hydrate(json_decode($json, true), new BidRequest());
    }

    public function testHydrateWithCompanionad()
    {
        $json = <<< JSON
{
    "id": "foo",
    "imp": [
        {
            "id": "1",
            "video": {
                "companionad": [
                    {
                        "w": 0,
                        "h": 0,
                        "mimes": [
                            "image/gif",
                            "image/jpeg",
                            "image/png",
                            "video/x-flv"
                        ]
                    }
                ]
            }
        }
    ]
}
JSON;

        $object = new BidRequest();

        Hydrator::hydrate(json_decode($json, true), $object);

        $this->assertInstanceOf(Banner::class, $object->getImp()->current()->getVideo()->getCompanionad()->current());
    }

    public function testHydrateWithBuyeruid()
    {
        $json = <<< JSON
{
    "id": "foo",
    "imp": [
        {
            "id": "1"
        }
    ],
    "user": {
        "buyeruid": "foo"
    }
}
JSON;

        $object = new BidRequest();

        Hydrator::hydrate(json_decode($json, true), $object);

        $this->assertEquals('foo', $object->getUser()->getBuyeruid());
    }

    public function testHydrateWithNonskippableVideo()
    {
        $json = <<< JSON
{
    "id": "foo",
    "imp": [
        {
            "id": "1",
            "video": {
                "skip": 0
            }
        }
    ]
}
JSON;

        $object = new BidRequest();

        Hydrator::hydrate(json_decode($json, true), $object);

        $this->assertEquals(0, $object->getImp()->current()->getVideo()->getSkip());
    }

    public function testHydrateWithSkippableVideo()
    {
        $json = <<< JSON
{
    "id": "foo",
    "imp": [
        {
            "id": "1",
            "video": {
                "skip": 1
            }
        }
    ]
}
JSON;

        $object = new BidRequest();

        Hydrator::hydrate(json_decode($json, true), $object);

        $this->assertEquals(1, $object->getImp()->current()->getVideo()->getSkip());
    }

    public function jsonProvider()
    {
        return [
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"267","name":"disqus"},"domain":"philstar.com","page":"http:\/\/www.philstar.com\/opinion\/2015\/08\/18\/1489348\/public-now-irrelevant-nomination-process","id":"1865","sectioncat":["IAB12"]},"imp":[{"tagid":"","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":300},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.48,"id":"1"}],"device":{"os":"iOS","ip":"49.144.161.68","osv":"8.4","geo":{"country":"PHL"},"dnt":0,"devicetype":1,"model":"iPad","ua":"Mozilla\/5.0 (iPad; CPU OS 8_4 like Mac OS X) AppleWebKit\/537.51.1 (KHTML, like Gecko) GSA\/4.0.1.31280 Mobile\/12H143 Safari\/9537.53"},"at":2,"test":0,"id":"3cbc1beb-56b2-4d1e-8335-beebc8d5c5cb","user":{"id":"dbabea9e54777949741bf96a0ac09aa53fbbc5ec"}}'],
            ['{"id":"5A8A217D-7375-494E-93BB-602642C5A624","imp":[{"id":"1","tagid":"272646","banner":{"w":0,"h":0},"ext":{"native":{"layout":3,"adunit":3,"assets":[{"id":1,"required":1,"title":{"len":150}},{"id":2,"required":1,"img":{"type":3,"wmin":100,"hmin":100}},{"id":6,"required":1,"data":{"type":2,"len":200}},{"id":15,"required":0,"data":{"type":11}},{"id":5,"required":0,"data":{"type":1}}]}}}],"site":{"id":"90689","domain":"http://floor6.com/MobWeb","page":"http://boredomtherapy.com/hidden-german-bunker/18/?as=6030080037884&pas=2","ref":"http://boredomtherapy.com/hidden-german-bunker/17/?as=6030080037884&pas=2","publisher":{"id":"50758"}},"device":{"ip":"24.19.196.154","ua":"Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12A365 [FBAN/FBIOS;FBAV/36.1.0.43.231;FBBV/13557860;FBDV/iPhone5,3;FBMD/iPhone;FBSN/iPhone OS;FBSV/8.0;FBSS/2; FBCR/Sprint;FBID/phone;FBLC/en_US;FBOP/5]","carrier":"Comcast Cable","language":"en-US,en;q=0.5","make":"Apple","model":"iPhone","os":"iOS","Osv":"8","osv":"8","devicetype":1,"geo":{"country":"US","region":"WA","city":"Bellingham","metro":"819","zip":"98225"},"ext":{"res":"320x568","pf":2}},"user":{"keywords":"twitter,friends,facebook,inbox,terrifying,stories,bunker,omg,subscribe,guys","geo":{"country":"US","region":"WA","city":"Bellingham","zip":"98226","metro":"819"}}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"267","name":"disqus"},"domain":"bootsnipp.com","page":"http:\/\/bootsnipp.com\/snippets\/featured\/responsive-navbar-brand-centered","id":"4365","sectioncat":["IAB19"]},"imp":[{"tagid":"ARF04O5JJfT0xtT3scb7fVRO9OUF6oJPz9-wQ4u7","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":300},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.48,"id":"1"}],"device":{"os":"Windows 7","ip":"120.96.34.19","osv":"","geo":{"country":"TWN"},"dnt":0,"devicetype":2,"model":"Other","ua":"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/44.0.2403.155 Safari\/537.36"},"at":2,"test":0,"id":"26128d00-3cf0-4b33-ad73-1b1af83d9b2b","user":{"id":"de10da4a53e497a3dd6735724be56266031b3861"}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"267","name":"disqus"},"domain":"sozcu.com.tr","page":"http:\/\/www.sozcu.com.tr\/2015\/gundem\/demirtastan-koalisyon-aciklamasi-3-912438\/","id":"3763","sectioncat":["IAB12"]},"imp":[{"tagid":"","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":300},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.48,"id":"1"}],"device":{"os":"Windows 7","ip":"78.170.254.250","osv":"","geo":{"country":"TUR"},"dnt":0,"devicetype":2,"model":"Other","ua":"Mozilla\/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko\/20100101 Firefox\/40.0"},"at":2,"test":0,"id":"ac3c44c3-ecca-47bd-83b6-70be06ff2b66","user":{"id":"5f2c0bde10a67b534f84193d132097dd3837dcca"}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"428","name":"epom"},"domain":"4shared.com","page":"http:\/\/search.4shared.com\/q\/CCAD\/1\/sims 1 rar","id":"1816","sectioncat":["IAB9","IAB12","IAB24"]},"imp":[{"tagid":"T1NNBiRhocoJlc-Y4N3EeCHmSLDs-jUPMsTNSEan","bidfloorcur":"USD","native":{"request":"{\"adunit\":5,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":200},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":0,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.5,"id":"1"}],"device":{"os":"BlackBerry OS","language":"en","geo":{"country":"GBR"},"osv":"7.1","dnt":0,"devicetype":1,"ip":"93.186.31.98","model":"BlackBerry 9380","ua":"Mozilla\/5.0 (BlackBerry; U; BlackBerry 9380; en) AppleWebKit\/534.11+ (KHTML, like Gecko) Version\/7.1.0.336 Mobile Safari\/534.11+"},"at":2,"test":0,"id":"a6f26a36-6e9e-40fe-a98b-5c304f1e5044","user":{"id":"47f3ceb7897045726e1254c5fb5744f1e6b90a7a"}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"316","name":"adsparc"},"domain":"webdunia.com","page":"http:\/\/hindi.webdunia.com\/sanatan-dharma-mahapurush\/12-shiva-mystery-114072300014_2.html","id":"1567","sectioncat":["IAB1","IAB12","IAB17"]},"imp":[{"tagid":"Me1iEROb6rAntyWoj6YAfC8mHBrSiw3j1K6T33jH","bidfloorcur":"USD","native":{"request":"{\"adunit\":5,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":200},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":1.5,"id":"1"}],"device":{"os":"Android","language":"en","geo":{"country":"IND"},"osv":"","dnt":0,"devicetype":1,"ip":"106.79.147.202","model":"Other","ua":"Opera\/9.80 (Android; Opera Mini\/7.6.40234\/37.6283; U; en) Presto\/2.12.423 Version\/12.16"},"at":2,"test":0,"id":"c576a6a4-80a1-409f-942f-5ce96d709fef","user":{"id":"8fc32951d3d7b8291bc2ce21b05e2115f5c25e78"}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"428","name":"epom"},"domain":"4shared.com","page":"http:\/\/search.4shared.com\/q\/CCAD\/020\/rude","id":"1816","sectioncat":["IAB9","IAB12","IAB24"]},"imp":[{"tagid":"T1NNBiRhocoJlc-Y4N3EeCHmSLDs-jUPMsTNSEan","bidfloorcur":"USD","native":{"request":"{\"adunit\":5,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":200},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":0,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.5,"id":"1"}],"device":{"os":"Android","language":"id","geo":{"country":"IDN"},"osv":"4.4.2","dnt":0,"devicetype":1,"ip":"202.67.40.31","model":"Lenovo A536","ua":"Mozilla\/5.0(Linux\/3.4.5; U; Android 4.4.2; zh-cn; Lenovo A536 Build\/KOT49H)AppleWebKit\/534.30 (KHTML, like Gecko) Version\/4.4.2 Mobile Safari\/534.30 Release\/01.17.2014"},"at":2,"test":0,"id":"22218b48-b537-4169-bc7c-71524da2caa2","user":{"id":"e8b1fd15d9116653e8231f8b5e3261b37a615a11"}}'],
            ['{"id":"23B19D2D-4BDF-425D-95E3-3FD55134F5B7","imp":[{"id":"1","tagid":"272646","banner":{"w":0,"h":0},"ext":{"native":{"layout":3,"adunit":3,"assets":[{"id":1,"required":1,"title":{"len":150}},{"id":2,"required":1,"img":{"type":3,"wmin":100,"hmin":100}},{"id":6,"required":1,"data":{"type":2,"len":200}},{"id":15,"required":0,"data":{"type":11}},{"id":5,"required":0,"data":{"type":1}}]}}}],"site":{"id":"90689","domain":"http://floor6.com/MobWeb","page":"http://tvtropes.org/pmwiki/pmwiki.php/Main/TheComputerIsACheatingBastard","ref":"http://tvtropes.org/pmwiki/pmwiki.php/Main/NoFairCheating","publisher":{"id":"50758"}},"device":{"ip":"67.243.24.67","ua":"Mozilla/5.0 (iPad; CPU OS 7_1_2 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Version/7.0 Mobile/11D257 Safari/9537.53","carrier":"Road Runner","language":"en-US,en;q=0.5","make":"Apple","model":"iPad","os":"iOS","Osv":"7","osv":"7","devicetype":5,"geo":{"country":"US","region":"NY","city":"New York","metro":"501","zip":"10023"},"ext":{"res":"768x1024","pf":2}},"user":{"keywords":"vanish,shotgun,sleeping,armies,stretch,shots,auto,ram,dogs,ogre mage","geo":{"country":"US","region":"NY","city":"Kingston","zip":"12401","metro":"501"}}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"267","name":"disqus"},"domain":"sozcu.com.tr","page":"http:\/\/www.sozcu.com.tr\/2015\/dunya\/malikiden-turkiyeye-sok-suclamalar-912393\/","id":"3763","sectioncat":["IAB12"]},"imp":[{"tagid":"","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":300},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":0.48,"id":"1"}],"device":{"os":"iOS","ip":"178.240.226.106","osv":"8.3","geo":{"country":"TUR"},"dnt":0,"devicetype":1,"model":"iPhone","ua":"Mozilla\/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit\/600.1.4 (KHTML, like Gecko) Version\/8.0 Mobile\/12F70 Safari\/600.1.4"},"at":2,"test":0,"id":"eb1f7194-334f-4bf3-a0cf-527cb634dd65","user":{"id":"55cf580d788236e72d7545e2171055e102836bec"}}'],
            ['{"siteId":0,"adId":0,"operId":0,"adtype":0,"inIframe":0,"adVisibility":0,"ranreq":0,"id":"0ec4be31-7cbe-4efd-8700-7caa88a5fc69","imp":[{"id":"1","native":{"request":"{\"native\":{\"layout\":1,\"adunit\":4,\"plcmtcnt\":1,\"seq\":0,\"assets\":[{\"id\":1,\"required\":1,\"title\":{\"len\":100}},{\"id\":2,\"required\":1,\"img\":{\"type\":3,\"w\":600,\"wmin\":0,\"h\":600,\"hmin\":0}},{\"id\":3,\"required\":1,\"data\":{\"type\":2,\"len\":200}},{\"id\":4,\"required\":0,\"data\":{\"type\":1,\"len\":200}}]}}"},"instl":0,"bidfloor":1.0,"secure":0}],"site":{"id":"11781","domain":"www.mobilelikez.com","cat":["IAB9","IAB2","IAB3","IAB5","IAB1","IAB22","IAB8","IAB7","IAB10","IAB14","IAB12","IAB6","IAB16","IAB17","IAB18","IAB19","IAB20","IAB4","IAB11","IAB13","IAB15","IAB21","IAB23"],"page":"http://www.mobilelikez.com/funny/10-signs-youre-dating-a-boy-not-a-man/page/4/?uid=303011935","privacypolicy":0,"publisher":{}},"device":{"dnt":0,"ua":"Mozilla/5.0 (iPhone; CPU iPhone OS 8_4_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12H321 Twitter for iPhone","ip":"187.119.144.125","js":0,"connectiontype":0,"devicetype":4},"user":{"id":"9bb8a0fd-6e35-4f41-a03c-5e887e430306","yob":0},"at":2,"tmax":100,"allimps":0,"cur":["USD"]}'],
            ['{"id":"[ID]","imp":[{"id":"[IMP-ID]","native":{"request":"{\"native\":{\"layout\":7,\"adunit\":2,\"plcmtcnt\":6,\"seq\":0,\"assets\":[{\"id\":1,\"title\":{\"len\":50}},{\"id\":2,\"required\":1,\"img\":{\"w\":100,\"h\":70}}]}}"},"bidfloor":0.0,"ext":{"bidmodel":"CPC"}}],"site":{"cat":["IAB3"],"page":"http://asdf.com/","keywords":"tech"},"device":{"ua":"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36","ip":"24.193.27.157"},"at":1,"ext":{"pmodel":"cpc"}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"400","name":"pbh_network"},"domain":"runt-of-the-web.com","page":"http:\/\/runt-of-the-web.com\/george-costanza-quotes?utm_source=facebook&utm_medium=social&utm_campaign=whfbpd","id":"1639","sectioncat":["IAB1"]},"imp":[{"tagid":"4584Tb0cLcKCVtrQcRL6xMJI1QDkI0QFGYDSZyOe","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":200},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":2.0,"id":"1"}],"device":{"os":"iOS","language":"en","geo":{"country":"USA"},"osv":"8.4.1","dnt":0,"devicetype":1,"ip":"96.234.206.64","model":"iPhone","ua":"Mozilla\/5.0 (iPhone; CPU iPhone OS 8_4_1 like Mac OS X) AppleWebKit\/600.1.4 (KHTML, like Gecko) Mobile\/12H321 [FBAN\/FBIOS;FBAV\/38.0.0.6.79;FBBV\/14316658;FBDV\/iPhone7,2;FBMD\/iPhone;FBSN\/iPhone OS;FBSV\/8.4.1;FBSS\/2; FBCR\/Verizon;FBID\/phone;FBLC\/en_US;FBOP\/5]"},"at":2,"test":0,"id":"36342d7b-3dba-4900-a5e2-5d2af37bc8b4","user":{"id":"9563ec6a0d5cb434e9bfe082a2cc98af9e9eb607"}}'],
            ['{"badv":[],"tmax":200,"site":{"publisher":{"id":"400","name":"pbh_network"},"domain":"runt-of-the-web.com","page":"http:\/\/runt-of-the-web.com\/george-costanza-quotes?utm_source=facebook&utm_medium=social&utm_campaign=whfbpd","id":"1639","sectioncat":["IAB1"]},"imp":[{"pmp":{"deals":[{"id":"abc"}]},"tagid":"4584Tb0cLcKCVtrQcRL6xMJI1QDkI0QFGYDSZyOe","bidfloorcur":"USD","native":{"request":"{\"adunit\":502,\"ver\":1,\"assets\":[{\"required\":1,\"id\":0,\"title\":{\"len\":120}},{\"required\":0,\"data\":{\"type\":2,\"len\":200},\"id\":1},{\"required\":1,\"data\":{\"type\":1},\"id\":2},{\"required\":0,\"data\":{\"type\":12},\"id\":3},{\"required\":0,\"id\":4,\"img\":{\"hmin\":60,\"wmin\":60,\"type\":1}},{\"required\":1,\"id\":5,\"img\":{\"hmin\":200,\"h\":260,\"type\":3,\"w\":300,\"wmin\":200}},{\"required\":0,\"video\":{\"protocols\":[2,3],\"maxduration\":3600,\"mimes\":[\"video\\\/x-flv\",\"video\\\/mp4\",\"video\\\/ogg\",\"video\\\/webm\"],\"minduration\":1},\"id\":5}],\"seq\":0,\"plcmtcnt\":1}","ver":"1.0.0.1"},"bidfloor":2.0,"id":"1"}],"device":{"os":"iOS","language":"en","geo":{"country":"USA"},"osv":"8.4.1","dnt":0,"devicetype":1,"ip":"96.234.206.64","model":"iPhone","ua":"Mozilla\/5.0 (iPhone; CPU iPhone OS 8_4_1 like Mac OS X) AppleWebKit\/600.1.4 (KHTML, like Gecko) Mobile\/12H321 [FBAN\/FBIOS;FBAV\/38.0.0.6.79;FBBV\/14316658;FBDV\/iPhone7,2;FBMD\/iPhone;FBSN\/iPhone OS;FBSV\/8.4.1;FBSS\/2; FBCR\/Verizon;FBID\/phone;FBLC\/en_US;FBOP\/5]"},"at":2,"test":0,"id":"36342d7b-3dba-4900-a5e2-5d2af37bc8b4","user":{"id":"9563ec6a0d5cb434e9bfe082a2cc98af9e9eb607"}}']
        ];
    }

    public function wrongJsonProvider()
    {
        return [
            ['{"app":{"name":"ABC News","bundle":"com.abcnews.ABCNews","id":"d4519606","publisher":{"id":"ae759c3e"},"cat":["IAB24","IAB13","IAB12","IAB3","IAB11"]},"device":{"connectiontype":0,"devicetype":4,"ip":"98.220.74.138","model":"iPhone","ua":"iPhone; iOS 8.3; ABC News; STR 2.2.4","geo":{"type":2,"metro":"527","country":"US"},"os":"iOS","ifa":"D247B3BB-F03F-426F-A8C8-4ED934EE9C53","osv":"unknown","make":"Apple","ext":{"idfasha1":"8f36739a173daeafc1bcbaeeb2869058aa1d553f"},"js":1,"dnt":0},"imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"id":"a0aaf758-201a-4fd0-bfe0-a0ffae32c985"}'],
            ['{"site":{"domain":"http://magiquiz.com","page":"http://magiquiz.com/quiz/where-should-you-live/?utm_source=facebook&utm_medium=ocpm&utm_term=Mobile-F25_34&utm_content=Nola&utm_campaign=MQ-Where_live","id":"160993bb","publisher":{"id":"3a7fddfa"},"cat":["IAB1","IAB24"]},"id":"410a4a19-b4d2-455e-a7e4-79db460aef27","imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"user":{"id":"uObIMwAK99OtaAAc"},"device":{"connectiontype":0,"devicetype":4,"ip":"76.187.75.89","model":"iPod Touch","ua":"Mozilla/5.0 (iPhone; CPU iPhone OS 8_4 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12H143 Safari/600.1.4","geo":{"type":2,"metro":"623","country":"US"},"os":"iOS","osv":"8","make":"Apple","js":1,"dnt":0}}'],
            ['{"app":{"name":"com.cheezburger.icanhas","bundle":"2.0.86","id":"c3d80edf","publisher":{"id":"172fc595"},"cat":["IAB1","IAB24","IAB16","IAB9"]},"device":{"connectiontype":0,"devicetype":4,"ip":"49.195.152.232","model":"SM-G900I","ua":"Dalvik/1.6.0 (Linux; U; Android 4.4.2; SM-G900I Build/KOT49H); STR cbc6090","geo":{"type":2,"metro":"200","country":"AU"},"os":"Android","osv":"","make":"Samsung","js":1,"dnt":0},"imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"id":"dd119c13-c2e1-4359-80c6-5833a450f4e2"}'],
            ['{"site":{"domain":"allday.com","page":"http://allday.com/post/5262-she-thought-it-was-just-a-normal-pimple-untilthe-smell/pages/2/","id":"dc4cabdc","publisher":{"id":"da3563b8"},"cat":["IAB1"]},"id":"39a2fb5d-3563-485b-ba27-1d35aa3f2083","imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"user":{"id":"lQFm4wAK99eHTe6b"},"device":{"connectiontype":0,"devicetype":4,"ip":"31.49.176.223","model":"A1549","ua":"Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12F70 [FBAN/FBIOS;FBAV/31.0.0.44.261;FBBV/10598108;FBDV/iPhone7,2;FBMD/iPhone;FBSN/iPhone OS;FBSV/8.3;FBSS/2; FBCR/vodafoneUK;FBID/phone;FBLC/en_GB;FBOP/5]","geo":{"type":2,"metro":"300","country":"GB"},"os":"iOS","osv":"","make":"Apple","js":1,"dnt":0}}'],
            ['{"app":{"name":"net.flixster.android","bundle":"7.4.3","id":"9e037903","publisher":{"id":"2fb9d1f3"},"cat":["IAB1"]},"device":{"connectiontype":0,"devicetype":4,"ip":"72.219.189.123","model":"SM-G900P","ua":"Dalvik/2.1.0 (Linux; U; Android 5.0; SM-G900P Build/LRX21T); STR 1.1.1","geo":{"type":2,"metro":"803","country":"US"},"os":"Android","osv":"","make":"Samsung","js":1,"dnt":0},"imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"id":"2c3a3a73-3eb4-40ff-a65f-5a80f9ed48d7"}'],
            ['{"id":"112fa29c-968c-4d3a-b295-3223fd7e4d46","seatbid":[{"seat":"C0","bid":[{"id":"imp-1-1","impid":"1","price":3.0212276506616,"nurl":"http:\/\/register.powerlinks.com\/win?a=%24%7BAUCTION_ID%7D&ab=%24%7BAUCTION_BID_ID%7D&ai=%24%7BAUCTION_IMP_ID%7D&as=%24%7BAUCTION_SEAT_ID%7D&aa=%24%7BAUCTION_AD_ID%7D&ap=%24%7BAUCTION_PRICE%7D&ac=%24%7BAUCTION_CURRENCY%7D&bidid=use-126fd272099e1afff1eb146a0c5fb04f&rid=612506d8-4582-11e5-9927-0ea06522b981","cid":"C0","crid":"-1","adm":"{\"native\":{\"assets\":[{\"title\":{\"text\":\"Home-Buying Basics: The Cash You Need to Close\"},\"id\":0,\"required\":1},{\"data\":{\"value\":\"Buying a home is a big deal, and there\\u2019s a lot to know. Get the basics, and...\"},\"id\":1,\"required\":0},{\"data\":{\"value\":\"Better Money Habits\"},\"id\":2,\"required\":1},{\"data\":{\"value\":\"CLICK HERE\"},\"id\":3,\"required\":0},{\"img\":{\"url\":\"http:\\\/\\\/cdn.bttrack.com\\\/a\\\/60\\\/60\\\/3071412\",\"w\":60,\"h\":60},\"id\":4,\"required\":0},{\"img\":{\"url\":\"http:\\\/\\\/cdn.bttrack.com\\\/a\\\/200\\\/200\\\/3071412\",\"w\":200,\"h\":200},\"id\":5,\"required\":1}],\"link\":{\"url\":\"http:\\\/\\\/register.powerlinks.com\\\/click?inventory_id=26790&domain_id=&creative_id=-1&exchange=1&campaign_id=0&format_id=3&bidid=use-126fd272099e1afff1eb146a0c5fb04f&rid=612506d8-4582-11e5-9927-0ea06522b981&ctype=cpm&third_party=17&dmd=iPhone&dos=iOS&dosv=8.4.1&redirect=http%3A%2F%2Fbttrack.com%2FClick%2FNative%3Fdata%3DOuJifVtEKZqw3CQ7Y5rtW7MSDuuHzuUgzKVD-5goSFVktbOBOorWHdosdAjAgNM88i-6yiBQW-qn1E-p-eI_lPaTqsmc0ACFdXaS0M1aff0EfrYS34MXYbPM6CWANAcTJFrEMsfv6pl64SH-n3o3VGhW7P_y0kL3zOpA6ahhajEZOy7ktE2yIK2b3CiGIfg90niupVvVU6yiZlkUT7r-1Ie_jd5yAe3rr2orSg_LR6mPWq_nww3TCnfvA5k1\"},\"imptrackers\":[\"http:\\\/\\\/register.powerlinks.com\\\/impression?inventory_id=26790&domain_id=&creative_id=-1&exchange=1&campaign_id=0&format_id=3&bidid=use-126fd272099e1afff1eb146a0c5fb04f&rid=612506d8-4582-11e5-9927-0ea06522b981&ctype=cpm&third_party=17&dmd=iPhone&dos=iOS&dosv=8.4.1&rtbap=%24%7BAUCTION_PRICE%7D&impu=http%3A%2F%2Fapi.bttrack.com%2Fwin%3Fts%3D1439886198%26id%3D94948b1f-8461-495e-9767-872a6901d55e%26cid%3D13585%26crid%3D344823%26pid%3D36341819%26data%3DOuJifVtEKZqw3Hw645qtW69SDiw62_-wHHOaNgtjqFMg-82yXiF1lVG3IeTgzlG5GdQkbNcAGK22RGXPQTOnMFj1LXHF9EJA0wVqNyR-boVKwxQrMAVZKAuBXXQjkDRl9Hd58-k7N_ujFBsbIat8FKJCw2VdeGe8Nw2%26price%3D4.0283035342154%26reqid%3D112fa29c-968c-4d3a-b295-3223fd7e4d46&otype=img\",\"http:\\\/\\\/bttrack.com\\\/Pixel\\\/Impression\\\/?data=OuJifVtEKZqw3Hw7af7tW7NSHotBj5mbLX7xPfTWCbsEXxUAgO3xUwNrJNwfLpiFP0ZQs9EiU3oIcza-aPwIaOH6-vmOXmLsljE1d5jSPc-CmYBu1owwzJjoInJPpkgWZZwhJr5e9DBBTGG_1lNnoov17HIcyxyyxnXOcIPr77-6pYFynFpyTvD648y-CJD0bABFZJO2acSb42jkb6ACPcGX7g6HQr1mf3a2UvdJdL3tbN-IvxmK-ce6bw1S9deZ9oo2zPUbYhCFvu7S71xdU-QtQOpYwnDqtu5tOoGOreWKC2JT5mTUgXEdFV4jHZ2o0&type=img\"]}}","adomain":["Better Money Habits"]}]}],"cur":"USD"}'],
            ['{"app":{"name":"MyFitnessPal","bundle":"com.myfitnesspal.mfp","id":"51929922","publisher":{"id":"60f84bc0"},"cat":["IAB7","IAB17"]},"device":{"connectiontype":0,"devicetype":4,"ip":"66.87.98.93","model":"iPhone","ua":"iPhone; iOS 8.4; MyFitnessPal; STR 2.2.4","geo":{"type":2,"metro":"623","country":"US"},"os":"iOS","ifa":"CFE76C8D-8763-4D6D-9AB3-D6F9793DACFF","osv":"unknown","make":"Apple","ext":{"idfasha1":"ee8d886927f4d9627c67550864c6351b03a7b07f"},"js":1,"dnt":0},"imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"id":"eb3763ae-7f81-4be0-98b7-c69d9184370a"}'],
            ['{"app":{"name":"Flixster","bundle":"com.jeffreygrossman.moviesapp","id":"8360dd7e","publisher":{"id":"2fb9d1f3"},"cat":["IAB1"]},"device":{"connectiontype":0,"devicetype":4,"ip":"92.6.186.73","model":"iPhone","ua":"iPhone; iOS 8.4; Flixster; STR 2.2.8","geo":{"type":2,"metro":"300","country":"GB"},"os":"iOS","ifa":"6D7FC508-CDB4-4979-8814-D6600270F1EA","osv":"unknown","make":"Apple","ext":{"idfasha1":"c82ecd71bc26f43d7e76eaceb3369b1c65b53919"},"js":1,"dnt":0},"imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"id":"d2b67b9d-2942-4f57-868d-850ebbfac81b"}'],
            ['{"site":{"domain":"cracked.com","page":"http://ignored/","id":"a27da424","publisher":{"id":"a3875efb"},"cat":["IAB1","IAB9"]},"device":{"connectiontype":0,"devicetype":4,"ip":"172.56.16.3","model":"MS323","ua":"Mozilla/5.0 (Linux; Android 4.4.2; LGMS323 Build/KOT49I.MS32310c) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36","geo":{"type":2,"metro":"803","country":"US"},"os":"Android","osv":"4","make":"LG","js":1,"dnt":0},"imp":[{"native":{"plcmtcnt":1,"assets":[{"id":1,"required":1,"title":{"len":140}},{"id":4,"required":0,"img":{"hmin":750,"wmin":1000,"type":3}},{"id":3,"required":0,"img":{"hmin":48,"wmin":48,"type":2}},{"id":2,"required":1,"img":{"hmin":180,"wmin":320,"type":1}},{"id":6,"required":1,"data":{"len":140,"type":2}},{"id":5,"required":1,"data":{"len":140,"type":1}}],"adunit":2,"ver":1,"layout":3},"id":"1"}],"id":"3774af16-ab14-4a24-86c6-5ac7458841a3"}'],
            ['{"id":"5CF396C9-F71D-4002-8FA2-793F2685628F","imp":[{"id":"1","tagid":"275677","banner":{"w":0,"h":0},"ext":{"native":{"ver":"1.0","assets":[{"id":1,"required":1,"img":{"w":150,"h":150,"type":1}},{"id":2,"required":0,"img":{"type":3}},{"id":3,"required":1,"title":{"len":25}},{"id":4,"required":1,"data":{"type":2,"len":67}},{"id":5,"required":1,"data":{"type":12,"len":15}},{"id":6,"required":0,"data":{"type":3}},{"id":7,"required":0,"img":{"type":2}}]}}}],"site":{"id":"91371","domain":"http://softonic.com","page":"http://m.en.softonic.com/","publisher":{"id":"54437"}},"device":{"ip":"168.235.197.204","ua":"UCWEB/2.0 (MIDP-2.0; U; Adr 4.4.2; en-US; A1 _Champ) U2/1.0.0 UCBrowser/10.2.0.584 U2/1.0.0 Mobile","language":"en-US","make":"Micromax","geo":{"country":"US","lat":34.1474991,"lon":-118.139999,"type":2},"ext":{"otherdeviceid":"8315142b26bdbaca972e398214d3d52a24afd076","hash":2,"res":"120x92","pf":2}},"user":{"keywords":"#global#"},"ext":{"bidguidefloor":1.2}}'],
        ];
    }
}