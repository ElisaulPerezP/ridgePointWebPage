<?php


use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Carousel;
use App\Models\User;
class Test extends TestCase
{
    use RefreshDatabase;
    
    public function testItCanCreateCarrousel(): void
    {
        $user = User::factory()->create();
        $permission = Permission::findOrCreate('api.store.Carousel', 'api');
        $role = Role::findOrCreate('admin', 'api')->givePermissionTo($permission);
        $user->assignRole($role);
        $carousel = Carousel::factory()->create([
            'user_id' => $admin->id,
            'photo' => $carousel->photo,
            'message' => "",
            'state' => 'on',
        ]);
        $response = $this->actingAs($user, 'api')->postJson(route('api.carousel.store', $carousel));

        $carouselCreated = Carousel::findOrFail($response->json()['data']['id']);
        $carouselCreated->assertEquals($admin->id, $carouselCreated->user_id);
        $response->assertCreated();
        $this->assertDatabaseCount('carousel', 1);
        $this->assertTrue(Cache::has('carousel'));
    }

    public function testItCanRetrieveCarrouselResource(): void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('api.carousel.index');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $admin->assignRole($role);
        $carousel = Carrousel::factory()->create();
        $response = $this->actingAs($admin, 'api')->getJson(route('api.carousel.index', $carousel->id));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'user_id',
                    'photo',
                    'message',
                    'state',
                ],
            ],
        ]);

        $this->assertTrue(Cache::has('carousel'));
    }
    public function testItCanRetrieveCarrouselIndex(): void
    {
        $admin = User::factory()->create();
        $carousel = Carousel::factory(10)->create();
        $permission = Permission::findOrCreate('api.carousel.index');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $admin->assignRole($role);

        $response = $this->actingAs($admin, 'api')->getJson(route('api.cart.index'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'user_id',
                    'photo',
                    'message',
                    'state',
                ],
            ],
        ]);

        $this->assertDatabaseCount('products', 10);
        $this->assertTrue(Cache::has('cart'));
    }

    public function testUpdateCarousel(): void
    {

        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('api.update.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $admin->assignRole($role);
        $carousel = Carousel::factory()->create([
            'user_id' => $admin->id,
            'photo' => '',
            'message'=> 'mesage test',
            'state' => 'on',]);
        $response = $this->actingAs($admin, 'api')->putJson(route('api.carousel.update', $carousel), [
            'user_id' => $admin->id,
            'photo' => '',
            'message'=> 'mesage test 2',
            'state' => 'off',
        ]);

        $carouselUpdated = Carousel::findOrFail($carousel->id);

        $response->assertOk();

        $this->assertDatabaseCount('carousel', 1);
        $this->assertFalse(Cache::has('carousel'));

        $this->assertEquals($carousel->user_id, $carouselUpdated->user_id);
        $this->assertEquals($carousel->photo, $carouselUpdated->photo);
        $this->assertEquals('mesage test 2', $carouselUpdated->message);
        $this->assertEquals('off', $carouselUpdated->state);
    }

    public function testItCanDeleteCarousel(): void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('api.destroy.cart', 'api');
        $role = Role::findOrCreate('admin', 'api')->givePermissionTo($permission);
        $admin->assignRole($role);

        $this->assertDatabaseCount('carousel', 0);

        $carousel = Carousel::factory()->create();

        $this->assertDatabaseCount('carousel', 1);

        $response = $this->actingAs($admin, 'api')->deleteJson(route('api.carousel.destroy', $carousel));

        $response->assertStatus(204);
        $this->assertDatabaseCount('carousel', 0);
        $this->assertFalse(Cache::has('carousel'));
    }
}
