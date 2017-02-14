<?php


namespace App\tests\functional;


class PostControllerCest
{
    public function it_can_list_post(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('List post');

        $I->amOnPage('/');

        $I->see('Posts');
        $I->see('Search posts');
        $I->seeElement('.search-query', ['placeholder' => 'Post title...']);
        $I->see('New post', '.new-post');
        $I->seeNumberOfElements('table.posts tbody tr', 3);
    }

    public function it_can_search_post(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('Search posts');

        $I->amOnPage('/');

        $searchQuery = 'Post title 2';
        $I->submitForm('.search-form', [
            'search-query' => $searchQuery
        ]);

        $I->seeCurrentUrlEquals('/?search-query=' . urlencode($searchQuery));
        $I->seeInField('search-query', $searchQuery);
        $I->seeNumberOfElements('table.posts tbody tr', 1);
    }

    public function it_can_show_new_post_form(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('View create post form');

        $I->amOnPage('/posts/create');

        $I->see('New post', 'h1');
        $I->canSeeInFormFields('form', [
            'title' => '',
            'body' => ''
        ]);

        $I->see('Save', '.btn-primary');
        $I->seeLink('Back', '/');
    }

    public function it_can_create_a_new_post(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('Create a new post');

        $I->amOnPage('/posts/create');
        $I->fillField('title', 'Test create title');
        $I->fillField('body', 'Test create body');
        $I->click('Save');

        $I->see('Post saved');
        $I->seeRecord('posts', [
            'title' => 'Test create title',
            'body' => 'Test create body'
        ]);
        $I->seeCurrentUrlEquals('/');
    }

    public function it_can_not_create_a_new_post_when_title_is_empty(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('Create a new post');

        $I->amOnPage('/posts/create');
        $I->fillField('title', '');
        $I->fillField('body', 'Test create body');
        $I->click('Save');

        $I->seeFormErrorMessage('title', 'The title field is required.');
        $I->dontSeeRecord('posts', [
            'title' => '',
            'body' => 'Test create body'
        ]);
    }

    public function it_can_not_create_a_new_post_when_body_is_empty(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('Create a new post');

        $I->amOnPage('/posts/create');
        $I->fillField('title', 'Test create title');
        $I->fillField('body', '');
        $I->click('Save');

        $I->seeFormErrorMessage('body', 'The body field is required.');
        $I->dontSeeRecord('posts', [
            'title' => 'Test create title',
            'body' => ''
        ]);
    }

    public function it_can_not_create_a_new_post_when_title_and_body_are_empty(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('Create a new post');

        $I->amOnPage('/posts/create');
        $I->fillField('title', '');
        $I->fillField('body', '');
        $I->click('Save');

        $I->seeFormErrorMessage('title', 'The title field is required.');
        $I->seeFormErrorMessage('body', 'The body field is required.');
        $I->dontSeeRecord('posts', [
            'title' => 'Test create title',
            'body' => 'Test create body'
        ]);
    }

    public function it_can_not_create_a_new_post_when_title_is_too_long(\FunctionalTester $I)
    {
        $I->am('Guest');
        $I->wantTo('Create a new post');

        $I->amOnPage('/posts/create');
        // 256 chars
        $longTitle = 'This is a very very very long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long  title';
        $I->fillField('title', $longTitle);
        $I->fillField('body', 'Test create body');
        $I->click('Save');

        $I->seeFormErrorMessage('title', 'The title may not be greater than 255 characters.');
        $I->dontSeeRecord('posts', [
            'body' => 'Test create body'
        ]);
    }
}