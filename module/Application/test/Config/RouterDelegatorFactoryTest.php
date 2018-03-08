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

namespace ApplicationTest\Config;

use Application\Action\HomePageAction;
use Application\Config\RouterDelegatorFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Zend\Expressive\Application;

/**
 * Class RouterDelegatorFactoryTest
 *
 * @package ApplicationTest\Config
 */
class RouterDelegatorFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var Application|ObjectProphecy $application */
        $application = $this->prophesize(Application::class);

        /** @var MethodProphecy $getMethod */
        $getMethod = $application->route('/', HomePageAction::class, ['GET', 'POST'], 'home');
        $getMethod->shouldBeCalled();

        $callable = function () use ($application) {
            return $application->reveal();
        };

        $factory = new RouterDelegatorFactory();

        $applicationReturn = $factory($container->reveal(), Application::class, $callable);

        $this->assertEquals($applicationReturn, $application->reveal());
    }
}
