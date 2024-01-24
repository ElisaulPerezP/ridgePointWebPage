<?php

namespace Tests\Feature;

use App\Models\Carousel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use PHPUnit\Framework\Assert;

class CarouselControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanIndexCarousel():void
    {

        Carousel::factory(10)->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('index.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response=$this->actingAs($admin)->get(route( 'carousels.index'));

        $response->assertOk();
        $response->assertViewIs('carousel.index');
        $response->assertViewHas('carousels');
        $response->assertSee('Home');
        $response->assertSee('About');
        $response->assertSee('Services');
        $response->assertSee('Projects');
        $response->assertSee('Blog');
        $response->assertSee('Dropdown');
        $response->assertSee('Contact');
        Assert::assertCount(10, $response->original->getData()['carousels']);

    }

    public function testItCanCreateCarousel(): void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('create.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $this->actingAs($admin);

        $response = $this->get(route('carousels.create'));

        $response->assertOk();

        $response->assertViewIs('carousel.create');

        $response->assertSee('Creating a new Carousel');

        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee('Message');
        $response->assertSee('Creation Date');
        $response->assertSee('Creation Place');
        $response->assertSee('Image Rights');
        $response->assertSee('Image');
        $response->assertSee('Submit');
    }



    public function testItCanStoreCarousel():void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('store.carousel'); // Adjust the permission
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $imagePath = storage_path('app/public/images/muestra.jpg');
        $uploadedFile = new UploadedFile($imagePath, 'muestra.jpg', 'image/jpeg', null, true);


        $response = $this->actingAs($admin)->post(route('carousels.store'), [
            'name' => 'Example Carousel',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Your example message',
            'creation_date' => now()->toDateString(),
            'creation_place' => 'Your creation place',
            'image_rights' => 'Your image rights',
            'image' => $uploadedFile,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('carousels', 1);
        $carousel = Carousel::first();
        $this->assertNotNull($carousel->getFirstMedia('carousel_images'));
    }

    public function testItCanShowCarousel():void
    {
        $carousel = Carousel::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('show.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->get(route('carousels.show', ['carousel' => $carousel->id]));
        $response->assertOk();

        $response->assertSee('Details for');

        $response->assertSee($carousel->name);
        $response->assertSee($carousel->description);
        $response->assertSee($carousel->message);
        $response->assertSee($carousel->creation_date);
        $response->assertSee($carousel->creation_place);
        $response->assertSee($carousel->image_rights);
        $response->assertSee('edit');

    }

    public function testItCanEditCarousel():void
    {
        $carousel = Carousel::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('edit.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->get(route('carousels.edit', ['carousel' => $carousel->id]));
        $response->assertOk();

        $response->assertSee('Edit for');

        $response->assertSee($carousel->name);
        $response->assertSee($carousel->description);
        $response->assertSee($carousel->message);
        $response->assertSee($carousel->creation_date);
        $response->assertSee($carousel->creation_place);
        $response->assertSee($carousel->image_rights);
        $response->assertSee('edit');
        $response->assertSee('delete');

    }
    public function testItCanUpdateCarousel():void
    {
        $carousel = Carousel::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('update.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $imagePath = storage_path('app/public/images/muestra.jpg');
        $uploadedFile = new UploadedFile($imagePath, 'muestra.jpg', 'image/jpeg', null, true);

$date= now()->toDateString();
        $response = $this->actingAs($admin)->put(route('carousels.update',  $carousel->id), [
            'name' => 'Edited Carousel Name',
            'description' => 'Edited Carousel Description.',
            'message' => 'Edited Message',
            'creation_date' => $date,
            'creation_place' => 'here',
            'image_rights' => 'New Rights',
            'image' => $uploadedFile,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('carousels.index'));

        $redirectResponse=$this->actingAs($admin)->get(route( 'carousels.index'));

        $redirectResponse->assertSee('Edited Carousel Name');
        $redirectResponse->assertSee('Edited Carousel Description.');
        $redirectResponse->assertSee('Edited Message');
        $redirectResponse->assertSee($date);
        $redirectResponse->assertSee('here');
        $redirectResponse->assertSee('New Rights');
    }

    public function testItCanDestroyCarousel():void
    {
        $carousel = Carousel::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('destroy.carousel');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);
        $this->assertDatabaseCount('carousels', 1);

        $response = $this->actingAs($admin)->delete(route('carousels.destroy', ['carousel' => $carousel->id]));

        $response->assertRedirect(route('carousels.index'));
        $this->assertDatabaseCount('carousels', 0);

    }
}
