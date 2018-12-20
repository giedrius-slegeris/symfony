<?php

namespace AppBundle;

class User
{

  public function getUsers() : array {
    return [
      [
        'id' => 1,
        'title' => 'Mr',
        'fname' => 'Giedrius',
        'lname' => 'Slegeris',
        'email' => 'giedrius@test.com',
        'tel' => '010203',
        'dob' => '01/02/2018',
        'address' => 'Some Address 123',
        'postcode' => '123456',
        'country' => 'UK'
      ]
    ];
  }

}
