<?php
namespace User\Grant;

use User\Entity\User;
use User\Service\UserService;
use Zend\Http\Request;
use Zend\Http\Response;
use ZfrOAuth2\Server\Entity\AccessToken;
use ZfrOAuth2\Server\Entity\Client;
use ZfrOAuth2\Server\Entity\RefreshToken;
use ZfrOAuth2\Server\Entity\TokenOwnerInterface;
use ZfrOAuth2\Server\Exception\OAuth2Exception;
use ZfrOAuth2\Server\Grant\AbstractGrant;
use ZfrOAuth2\Server\Grant\AuthorizationServerAwareInterface;
use ZfrOAuth2\Server\Grant\AuthorizationServerAwareTrait;
use ZfrOAuth2\Server\Grant\RefreshTokenGrant;
use ZfrOAuth2\Server\Service\TokenService;

class GoogleGrant extends AbstractGrant implements AuthorizationServerAwareInterface
{
    use AuthorizationServerAwareTrait;

    const GRANT_TYPE          = 'google';
    const GRANT_RESPONSE_TYPE = null;

    protected $accessTokenService;
    protected $refreshTokenService;
    protected $userService;

    public function __construct(
        TokenService $accessTokenService,
        TokenService $refreshTokenService,
        UserService  $userService
    ) {
        $this->accessTokenService  = $accessTokenService;
        $this->refreshTokenService = $refreshTokenService;
        $this->userService         = $userService;
    }

    public function createAuthorizationResponse(Request $request, Client $client, TokenOwnerInterface $owner = null)
    {
        throw OAuth2Exception::invalidRequest(ucfirst(self::GRANT_TYPE) .' grant does not support authorization');
    }

    public function createTokenResponse(Request $request, Client $client = null, TokenOwnerInterface $owner = null)
    {
        // TODO: Complete rewrite. This is just a temp method to allow token generation
        $owner = $this->userService->get($request->getPost('id'));
        if (!$owner instanceof User) {
            throw OAuth2Exception::accessDenied('access_denied');
        }

        /**
         * @var AccessToken       $accessToken
         * @var null|RefreshToken $refreshToken
         * */
        $accessToken  = new AccessToken();
        $refreshToken = null;

        $this->populateToken($accessToken, $client, $owner, 'foobar');
        $accessToken = $this->accessTokenService->createToken($accessToken);

        // Before generating a refresh token, we must make sure the authorization server supports this grant
        if ($this->authorizationServer->hasGrant(RefreshTokenGrant::GRANT_TYPE)) {
            $refreshToken = new RefreshToken();
            $this->populateToken($refreshToken, $client, $owner, 'foobar');
            $refreshToken = $this->refreshTokenService->createToken($refreshToken);
        }

        return $this->prepareTokenResponse($accessToken, $refreshToken);
    }

    public function allowPublicClients()
    {
        return true;
    }
}
