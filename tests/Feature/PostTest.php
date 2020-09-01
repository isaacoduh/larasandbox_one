<?php

namespace Tests\Feature;

use App\BlogPost;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');
        $response->assertSee('No blog posts yet!');
    }

    public function testSeeOneBlogPostWhenThereIsOneWithNoComments()
    {
        // arrange
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New Title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testSeeOneBlogPostWithComments()
    {
        // Arrange
        $post = $this->createDummyBlogPost();
        factory(Comment::class, 4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');

    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid Title',
            'content' => 'At least 10 characters',
        ];

        $this->actingAs($this->user())->post('/posts', $params)->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog post was created!');
    }

    public function testStoreFail()
    {
        $params = ['title' => 'x', 'content' => 'x'];
        $this->actingAs($this->user())->post('/posts', $params)->assertStatus(302)->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', $post->toArray());
        $params = ['title' => 'A new named title', 'content' => 'Content has changed'];
        $this->actingAs($this->user())->put("/posts/{$post->id}", $params)->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', ['title' => 'A new named title']);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->actingAs($this->user())->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'),'Blog post was deleted!');
        $this->assertSoftDeleted('blog_post', $post->toArray());
    }

    private function createDummyBlogPost(): BlogPost
    {
        return factory(BlogPost::class)->states('new-title')->create();
    }
}
