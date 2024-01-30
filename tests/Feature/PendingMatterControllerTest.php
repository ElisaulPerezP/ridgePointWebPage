<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PendingMatter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use PHPUnit\Framework\Assert;

class PendingMatterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanIndexPendingMatter(): void
    {
        PendingMatter::factory(10)->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('index.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->get(route('pendingMatters.index'));

        $response->assertOk();
        $response->assertViewIs('pendingMatter.index');
        $response->assertViewHas('pendingMatters');
        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee('Message');
        $response->assertSee('Client');
        $response->assertSee('Responsible');
        Assert::assertCount(10, $response->original->getData()['pendingMatters']);
    }

    public function testItCanCreatePendingMatter(): void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('create.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $this->actingAs($admin);

        $response = $this->get(route('pendingMatters.create'));

        $response->assertOk();
        $response->assertViewIs('pendingMatter.create');
        $response->assertSee('Create a new Pending Matter');
        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee('Message');
        $response->assertSee('Client');
        $response->assertSee('Responsible');
        $response->assertSee('Submit');
    }

    public function testItCanStorePendingMatter(): void
    {
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('store.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->post(route('pendingMatters.store'), [
            'name' => 'Example Pending Matter',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Your example message',
            'creation_date' => now()->toDateString(),
            'creation_place' => 'Your creation place',
            'client_id' => $admin->id,
            'responsible_id' => $admin->id,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('pending_matters', 1);
        $pendingMatter = PendingMatter::first();
        $this->assertEquals($admin->id, $pendingMatter->client_id);
        $this->assertEquals($admin->id, $pendingMatter->responsible_id);
    }

    public function testItCanShowPendingMatter(): void
    {
        $pendingMatter = PendingMatter::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('show.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->get(route('pendingMatters.show', ['pendingMatter' => $pendingMatter->id]));
        $response->assertOk();

        $response->assertSee('Details for');
        $response->assertSee($pendingMatter->name);
        $response->assertSee($pendingMatter->description);
        $response->assertSee($pendingMatter->message);
        $response->assertSee($pendingMatter->creation_date);
        $response->assertSee($pendingMatter->creation_place);
        $response->assertSee('Client');
        $response->assertSee('Responsible');
        $response->assertSee('edit');
    }

    public function testItCanEditPendingMatter(): void
    {
        $pendingMatter = PendingMatter::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('edit.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->get(route('pendingMatters.edit', ['pendingMatter' => $pendingMatter->id]));
        $response->assertOk();

        $response->assertSee('Edit for');
        $response->assertSee($pendingMatter->name);
        $response->assertSee($pendingMatter->description);
        $response->assertSee($pendingMatter->message);
        $response->assertSee($pendingMatter->creation_date);
        $response->assertSee($pendingMatter->creation_place);
        $response->assertSee('Client');
        $response->assertSee('Responsible');
        $response->assertSee('edit');
        $response->assertSee('delete');
    }

    public function testItCanUpdatePendingMatter(): void
    {
        $pendingMatter = PendingMatter::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('update.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response = $this->actingAs($admin)->put(route('pendingMatters.update', $pendingMatter->id), [
            'name' => 'Edited Pending Matter Name',
            'description' => 'Edited Pending Matter Description.',
            'message' => 'Edited Message',
            'creation_date' => now()->toDateString(),
            'creation_place' => 'here',
            'client_id' => $admin->id,
            'responsible_id' => $admin->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('pendingMatters.index'));

        $redirectResponse = $this->actingAs($admin)->get(route('pendingMatters.index'));

        $redirectResponse->assertSee('Edited Pending Matter Name');
        $redirectResponse->assertSee('Edited Pending Matter Description.');
        $redirectResponse->assertSee('Edited Message');
    }

    public function testItCanDestroyPendingMatter(): void
    {
        $pendingMatter = PendingMatter::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('destroy.pendingMatter');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);
        $this->assertDatabaseCount('pending_matters', 1);

        $response = $this->actingAs($admin)->delete(route('pendingMatters.destroy', ['pendingMatter' => $pendingMatter->id]));

        $response->assertRedirect(route('pendingMatters.index'));
        $this->assertDatabaseCount('pending_matters', 0);
    }
}
