<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use PHPUnit\Framework\Assert;

class QuoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanIndexQuote():void
    {

        Quote::factory(10)->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('index.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response=$this->actingAs($admin)->get(route( 'quotes.index'));

        $response->assertOk();
        $response->assertViewIs('quote.index');
        $response->assertViewHas('quotes');
        $response->assertSee('Home');
        $response->assertSee('About');
        $response->assertSee('Services');
        $response->assertSee('Projects');
        $response->assertSee('Blog');
        $response->assertSee('Dropdown');
        $response->assertSee('Contact');
        Assert::assertCount(10, $response->original->getData()['quotes']);

    }

    public function testItCanCreateQuote(): void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('create.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $this->actingAs($admin);

        $response = $this->get(route('quotes.create'));

        $response->assertOk();

        $response->assertViewIs('quote.create');

        $response->assertSee('Create a new Quote');

        $response->assertSee('Name');
        $response->assertSee('Phone');
        $response->assertSee('Email');
        $response->assertSee('Description');
        $response->assertSee('Message');
        $response->assertSee('Address');
        $response->assertSee('Image');
        $response->assertSee('Submit');
    }



    public function testItCanStoreQuote():void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('store.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $imagePath = storage_path('app/public/images/quoteSampleImage.jpg');
        $uploadedFile = new UploadedFile($imagePath, 'muestra.jpg', 'image/jpeg', null, true);


        $response = $this->actingAs($admin)->post(route('quotes.store'), [
            'name' => 'Example quote',
            'phone' => '123456789',
            'email' => 'example@example.com',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Your example message',
            'creation_place' => 'Your creation place',
            'image_rights' => 'on',
            'image' => $uploadedFile,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('quotes', 1);
        $quote = quote::first();
        $this->assertNotNull($quote->getFirstMedia('quote_images'));
    }

    public function testItCanShowQuote():void
    {
        $quote = Quote::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('show.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);
        $response = $this->actingAs($admin)->get(route('quotes.show', ['quote' => $quote->id]));
        $response->assertOk();

        $response->assertSee('Details for');

        $response->assertSee($quote->name);
        $response->assertSee($quote->description);
        $response->assertSee($quote->message);
        $response->assertSee($quote->creation_date);
        $response->assertSee($quote->creation_place);
        $response->assertSee($quote->image_rights);
        $response->assertSee('edit');

    }

    public function testItCanEditquote():void
    {
        $quote = quote::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('edit.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->get(route('quotes.edit', ['quote' => $quote->id]));
        $response->assertOk();

        $response->assertSee('Edit for');

        $response->assertSee($quote->name);
        $response->assertSee($quote->description);
        $response->assertSee($quote->message);
        $response->assertSee($quote->creation_date);
        $response->assertSee($quote->creation_place);
        $response->assertSee('edit');
        $response->assertSee('delete');

    }
    public function testItCanUpdatequote():void
    {
        $quote = quote::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('update.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $imagePath = storage_path('app/public/images/muestra.jpg');
        $uploadedFile = new UploadedFile($imagePath, 'muestra.jpg', 'image/jpeg', null, true);

$date= now()->toDateString();
        $response = $this->actingAs($admin)->put(route('quotes.update',  $quote->id), [
            'name' => 'Example quote',
            'phone' => '123456789',
            'email' => 'example@example.com',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Your example message',
            'creation_place' => 'Your creation place',
            'creation_date' => $date,
            'image_rights' => 'on',
            'image' => $uploadedFile,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('quotes.index'));

        $redirectResponse=$this->actingAs($admin)->get(route( 'quotes.index'));

        $redirectResponse->assertSee('Example quote');
        $redirectResponse->assertSee('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
        $redirectResponse->assertSee($date);
    }

    public function testItCanDestroyquote():void
    {
        $quote = quote::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('destroy.quote');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);
        $this->assertDatabaseCount('quotes', 1);

        $response = $this->actingAs($admin)->delete(route('quotes.destroy', ['quote' => $quote->id]));

        $response->assertRedirect(route('quotes.index'));
        $this->assertDatabaseCount('quotes', 0);

    }
}
