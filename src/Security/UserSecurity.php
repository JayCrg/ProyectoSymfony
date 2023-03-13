<?php
// src/Service/ExampleService.php
// ...

use Symfony\Bundle\SecurityBundle\Security;

class UserSecurity
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    public function someMethod()
    {
        // returns User object or null if not authenticated
        $user = $this->security->getUser();

        // ...
    }
}