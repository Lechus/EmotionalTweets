<?php namespace Lpp\Services\Validation;

/**
 * Validator - gather input, test input validity and retrieve error messages.
 * @author lpp
 */
interface ValidableInterface
{

    /**
     * Add data to validation against
     *
     * @param array
     * @return \Lpp\Services\Validation\ValidableInterface $this
     */
    public function with(array $input);

    /**
     * Test if validation passes
     *
     * @return boolean
     */
    public function passes();

    /**
     * Retrieve validation errors
     *
     * @return array
     */
    public function errors();
}
