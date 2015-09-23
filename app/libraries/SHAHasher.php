<?php namespace Illuminate\Hashing;

class SHAHasher implements HasherInterface {

    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @return array   $options
     * @return string
     */
    public function make($value, array $options = array()) {
        return hash('sha1', $value.'rS24PoJSARl7jCV4ICoimaAeK6fzfoN1');
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = array()) {
        $saltedValue = $value."rS24PoJSARl7jCV4ICoimaAeK6fzfoN1";
        if(hash('sha1', $saltedValue) === $hashedValue){
            return true;
        }
            return false;
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = array()) {
        return false;
    }

}