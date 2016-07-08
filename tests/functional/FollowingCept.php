<?php

$I = new FunctionalTester($scenario);

$I->am('a Larabook user.');
$I->wantTo('follow other Larabook users.');

$I->haveAnAccount(['username' => 'AnotherUser']);
$I->signIn();

$I->click('Browse Users');
$I->seeCurrentUrlEquals('/users');
$I->click('AnotherUser');

$I->seeCurrentUrlEquals('/@AnotherUser');
$I->click('Follow AnotherUser');
$I->seeCurrentUrlEquals('/@AnotherUser');

$I->see('Unfollow AnotherUser');
