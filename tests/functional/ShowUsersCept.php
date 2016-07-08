<?php


$I = new FunctionalTester($scenario);
$I->am('a Larabook member');
$I->wantTo('review all users who are registered for Larabook');

$I->haveAnAccount(['username' => 'aaa']);
$I->haveAnAccount(['username' => 'bbb']);

$I->amOnPage('/users');
$I->see('aaa');
$I->see('bbb');
