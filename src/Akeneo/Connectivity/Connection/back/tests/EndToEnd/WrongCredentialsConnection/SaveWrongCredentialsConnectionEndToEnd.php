<?php
declare(strict_types=1);


namespace Akeneo\Connectivity\Connection\back\tests\EndToEnd\WrongCredentialsConnection;

use Akeneo\Connectivity\Connection\Domain\Settings\Model\ValueObject\ConnectionCode;
use Akeneo\Test\Integration\Configuration;
use Akeneo\Tool\Bundle\ApiBundle\tests\integration\ApiTestCase;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author    Willy Mesnage <willy.mesnage@akeneo.com>
 * @copyright 2020 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SaveWrongCredentialsConnectionEndToEnd extends ApiTestCase
{
    public function test_that_authentication_with_good_combination_does_not_save_wrong_credentials()
    {
        $apiConnection = $this->createConnection('magento');

        $apiClient = static::createClient(['debug' => false]);
        $apiClient->request('POST', 'api/oauth/v1/token',
            [
                'username'   => $apiConnection->username(),
                'password'   => $apiConnection->password(),
                'grant_type' => 'password',
            ],
            [],
            [
                'PHP_AUTH_USER' => $apiConnection->clientId(),
                'PHP_AUTH_PW'   => $apiConnection->secret(),
                'CONTENT_TYPE'  => 'application/json',
            ]
        );
        Assert::assertEquals(Response::HTTP_OK, $apiClient->getResponse()->getStatusCode());

        $wrongCredentialsCombination = $this->findAllWrongCredentialsCombination();
        Assert::assertEmpty($wrongCredentialsCombination);
    }

    public function test_that_wrong_credentials_combination_is_saved_after_authentication()
    {
        $magentoConnection = $this->createConnection('magento');
        $bynderConnection = $this->createConnection('bynder');

        $apiClient = static::createClient(['debug' => false]);
        $apiClient->request('POST', 'api/oauth/v1/token',
            [
                'username'   => $magentoConnection->username(),
                'password'   => $magentoConnection->password(),
                'grant_type' => 'password',
            ],
            [],
            [
                'PHP_AUTH_USER' => $bynderConnection->clientId(),
                'PHP_AUTH_PW'   => $bynderConnection->secret(),
                'CONTENT_TYPE'  => 'application/json',
            ]
        );
        Assert::assertEquals(Response::HTTP_OK, $apiClient->getResponse()->getStatusCode());

        $wrongCredentialsCombination = $this->findAllWrongCredentialsCombination();

        /* TODO: Assert the good thing once done */
        Assert::assertIsArray($wrongCredentialsCombination);
        Assert::assertNotEmpty($wrongCredentialsCombination);
    }

    private function findAllWrongCredentialsCombination(): ?array
    {
        $repository = $this->get('akeneo_connectivity.connection.persistence.repository.wrong_credentials_combination');

        return $repository->findAll(new \DateTime('now - 1 day', new \DateTimeZone('UTC')));
    }

    protected function getConfiguration(): Configuration
    {
        return $this->catalog->useMinimalCatalog();
    }
}
