<?php
/**
 * Skeleton application to build voice applications for Amazon Alexa with phlexa, PHP and Zend\Expressive
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa-expressive-skeleton
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

namespace ApplicationTest\Action;

use Application\Action\HomePageAction;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

/**
 * Class HomePageActionTest
 *
 * @package ApplicationTest\Action
 */
class HomePageActionTest extends TestCase
{
    /**
     *
     */
    public function testResponse()
    {
        $homePage = new HomePageAction();

        /** @var ServerRequestInterface $request */
        $request = $this->prophesize(ServerRequestInterface::class)->reveal();

        /** @var DelegateInterface $delegate */
        $delegate = $this->prophesize(DelegateInterface::class)->reveal();

        /** @var Response $response */
        $response = $homePage->process($request, $delegate);

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof Response\JsonResponse);

        $json = json_decode((string)$response->getBody());

        $this->assertEquals(
            'Welcome to the phlexa skeleton application',
            $json->hello
        );
    }
}
