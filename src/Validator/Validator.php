<?php

declare(strict_types=1);

namespace Lexal\LaravelStepValidator\Validator;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Lexal\LaravelStepValidator\Entity\RulesDefinition;
use Lexal\LaravelStepValidator\Validator\Exception\ValidatorException;

class Validator implements ValidatorInterface
{
    public function __construct(private ValidationFactory $validatorFactory)
    {
    }

    public function validate(array $data, RulesDefinition $definition): void
    {
        $validator = $this->validatorFactory->make(
            $data,
            $definition->getRules(),
            $definition->getMessages(),
            $definition->getCustomAttributes(),
        );

        if ($validator->fails()) {
            throw new ValidatorException($validator->errors()->messages());
        }
    }
}
