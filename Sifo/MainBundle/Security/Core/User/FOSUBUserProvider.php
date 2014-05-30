<?php

namespace Sifo\MainBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass {

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response) {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();

        $setter = 'set' . ucfirst($service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';

//we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }

        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response) {
        $username = $response->getUsername();
        //$useremail = $response->getEmail();
        //$realname = $response->getRealName();

        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        // exit($username."-".$user);
        // exit($username);
        //when there is no user connected to this facebook_id
        if (null === $user) {
            //$service = $response->getResourceOwner()->getName();
            //$setter = 'set'.ucfirst($service);
            //$setter_id = $setter.'Id';
            //$setter_token = $setter.'AccessToken';
            // create new user here
            //$user = $this->userManager->createUser();
            //$user->$setter_id($username);
            //$user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            //$user->setUsername($realname);
            //$user->setEmail($useremail);
            //$user->setUsername($username);
            //$user->setEmail($username);
            //$user->setPlainPassword($username);
            //$user->setEnabled(true);
            //$this->userManager->updateUser($user);
            //return $user;
            exit('No User connected to this facebook account!');
        }
        
        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        //update access token
        $user->$setter($response->getAccessToken());

        return $user;
        
    }

}
