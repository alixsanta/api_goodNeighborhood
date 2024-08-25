<?php

namespace App\Tests;

use App\Service\PasswordService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PasswordServiceTest extends KernelTestCase
{
    private $passwordHasherMock;
    private $passwordService;


    protected function setUp(): void
    {
        $this->passwordHasherMock = $this->createMock(UserPasswordHasherInterface::class);
        $this->passwordService = new PasswordService($this->passwordHasherMock);
    }
    public function testValidatePasswordComplexitySuccess()
    {
        $result = $this->passwordService->validatePasswordComplexity('Password1!*');
        $this->assertTrue($result);
    }
    public function testValidatePasswordComplexityFailsWithoutSpecialChar()
    {
        $result = $this->passwordService->validatePasswordComplexity('Password1');
        $this->assertFalse($result);
    }
    public function testValidatePasswordComplexityFailsWithoutUppercase()
    {
        $result = $this->passwordService->validatePasswordComplexity('password1!*');
        $this->assertFalse($result);
    }
    public function testHashPassword()
    {
        $userMock = $this->createMock(PasswordAuthenticatedUserInterface::class);
        $this->passwordHasherMock
            ->expects($this->once())
            ->method('hashPassword')
            ->with($userMock, 'plainPassword')
            ->willReturn('hashedPassword');
        $hashedPassword = $this->passwordService->hashPassword($userMock, 'plainPassword');
        $this->assertEquals('hashedPassword', $hashedPassword);
    }
    public function testIsPasswordValid()
    {
        $userMock = $this->createMock(PasswordAuthenticatedUserInterface::class);
        $this->passwordHasherMock
            ->expects($this->once())
            ->method('isPasswordValid')
            ->with($userMock, 'plainPassword')
            ->willReturn(true);
        $isValid = $this->passwordService->isPasswordValid($userMock, 'plainPassword');
        $this->assertTrue($isValid);
}
    }
