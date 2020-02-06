<?php
declare(strict_types=1);

namespace Akeneo\Connectivity\Connection\Domain\WrongCredentialsConnection\Model\Write;

/**
 * @author    Willy Mesnage <willy.mesnage@akeneo.com>
 * @copyright 2020 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class WrongCredentialsCombination
{
    /** @var string */
    private $username;

    /** @var string */
    private $connectionCode;

    public function __construct(string $connectionCode, string $username)
    {
        $this->connectionCode = $connectionCode;
        $this->username = $username;
    }

    public function username()
    {
        return $this->username;
    }

    public function connectionCode()
    {
        return $this->connectionCode;
    }
}
