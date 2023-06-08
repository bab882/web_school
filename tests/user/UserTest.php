<?php

/**
 * Ce test unitaire couvre les méthodes principales de l'entité User, en vérifiant les fonctionnalités telles que la récupération de l'identifiant, la définition et la récupération de l'e-mail, la récupération de l'identifiant utilisateur, la gestion des rôles, la définition et la récupération du mot de passe, la vérification du statut de vérification, la définition et la récupération du prénom, la définition et la récupération du nom de famille, la définition et la récupération de la date de création et de mise à jour.
 */
namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testSetAndGetEmail()
    {
        $user = new User();
        $email = 'test@example.com';

        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
    }

    public function testGetUserIdentifier()
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);

        $this->assertEquals($email, $user->getUserIdentifier());
    }

    public function testGetRoles()
    {
        $user = new User();
        $roles = $user->getRoles();

        $this->assertIsArray($roles);
        $this->assertContains('ROLE_USER', $roles);
        $this->assertContains('ROLE_SUPER_ADMIN', $roles);
    }

    public function testSetAndGetPassword()
    {
        $user = new User();
        $password = 'password123';

        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }

    public function testIsVerified()
    {
        $user = new User();
        $this->assertFalse($user->isVerified());

        $user->setIsVerified(true);
        $this->assertTrue($user->isVerified());
    }

    public function testSetAndGetFirstname()
    {
        $user = new User();
        $firstname = 'John';

        $user->setFirstname($firstname);
        $this->assertEquals($firstname, $user->getFirstname());
    }

    public function testSetAndGetLastname()
    {
        $user = new User();
        $lastname = 'Doe';

        $user->setLastname($lastname);
        $this->assertEquals($lastname, $user->getLastname());
    }

    public function testSetAndGetCreatedAt()
    {
        $user = new User();
        $createdAt = new \DateTimeImmutable();

        $user->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $user->getCreatedAt());
    }

    public function testSetAndGetUpdatedAt()
    {
        $user = new User();
        $updatedAt = new \DateTimeImmutable();

        $user->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $user->getUpdatedAt());
    }
}
