<?php

namespace App\Service;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationUserValues
{
    private $validatorInterface;

    public function __construct(ValidatorInterface $validatorInterface)
    {
        $this->validatorInterface = $validatorInterface;
    }

    /**
     * Check if the entity is valid
     *
     * @param $entity The entity to check
     * @return boolean
     */
    public function isValidEntity($entity): bool
    {
        // Check if each value respects the validation constraints
        $errors = $this->validatorInterface->validate($entity);

        // If an error has occurred
        if (count($errors) > 0) {

            return true;
        }

        return false;
    }

    /**
     * Check if all keys exist in the data array
     *
     * @param array $data The data array to check
     * @param array $keys The array of keys to check
     * @return boolean
     */
    public function isKeyExist(array $data, array $keys): bool
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {

                return false;
            }
        }

        return true;
    }
}
