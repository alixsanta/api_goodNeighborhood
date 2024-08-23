<?php

namespace App\Security\Voter;

use App\Entity\ResidentGroup;
use App\Repository\ResidentGroupRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;


class ResidentGroupVoter extends Voter
{
    public const MODIFY = 'RESIDENT_GROUP_MODIFY';
    public const DELETE = 'RESIDENT_GROUP_DELETE';
    public const SHOW = 'RESIDENT_GROUP_SHOW';
    public const LIST = 'RESIDENT_GROUP_LIST';

    public function __construct(private readonly ResidentGroupRepository $residentGroupRepository, Security $security)
    {
    }

    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::DELETE, self::LIST, self::MODIFY, self::SHOW])
            && ($subject instanceof ResidentGroup || $subject === null);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::DELETE:
                return $this->allowDelete($user, $subject);
            case self::SHOW:
                return $this->allowShow($user,$subject);
            case self::MODIFY:
                return $this->allowModify($user,$subject);
            case self::LIST:
                return $this->allowList();
        }

        return false;
    }

    private function allowModify(UserInterface $user, ResidentGroup $subject): bool
    {
        if ($this->isGranted('ROLE_ADMINISTRATOR') || $user === $subject->getUUIDUser()) {
            return true;
        }

        return false;
    }

    private function allowDelete(UserInterface $user, ResidentGroup $subject): bool
    {
        if ($this->isGranted('ROLE_ADMINISTRATOR')) {
            return true;
        }

        return false;
    }

    private function allowShow(UserInterface $user, ResidentGroup $subject): bool
    {
        if ($this->isGranted('ROLE_ADMINISTRATOR') || $this->residentGroupRepository->findResidentGroupByUser($user, $subject)) {
            return true;
        }

        return false;
    }
    private function allowList(): bool
    {

        if ($this->$security->isGranted('ROLE_ADMINISTRATOR')) {
            return true;
        }

        return false;
    }
}
