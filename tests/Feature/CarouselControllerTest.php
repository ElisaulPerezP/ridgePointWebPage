<?php

namespace Tests\Feature;

use App\Models\Carousel;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CarouselControllerTest extends TestCase
{
    public function testItCanIndexCarousel():void
    {
        $carousel = Carousel::factory()->create();
        $admin = User::factory()->create();
        $permission = Permission::findOrCreate('api.index.product');
        $role = Role::findOrCreate('admin')->givePermissionTo($permission);
        $permission->assignRole($role);

        $response=$this->actingAs($admin)->get(route( 'carousels.index'));

        $response->assertOk();
        $response->assertViewIs('carousel.index');
        $response->assertViewHas('carousels');
        $response->assertSee('Ridge-Point Construction');
        $response->assertSee('Home');
        $response->assertSee('About');
        $response->assertSee('Services');
        $response->assertSee('Projects');
        $response->assertSee('Blog');
        $response->assertSee('Dropdown');
        $response->assertSee('Contact');



        //crea un carousel con la fábrica ................... LISTO
        //como administrador consultar la ruta............... LISTO
        //se obtiene ok...................................... LISTO
        //se renderiza el layaut.............................. todo
        //se renderiza el componente de diseño................ todo
        //se renderizan el componente individual.............. todo
    }

    public function testItCanCreateCarousel():void
    {
        //como administrador constulta la ruta................ todo
        //obtiene el codigo correcto.......................... todo
        //exiten los campos corespondientes a
        // la creacion de un carousel......................... todo
        //existe un boton submit.............................. todo
    }

    public function testItCanStoreCarousel():void
    {
        //como admin se solicita el formulario................ todo
        //se obtiene el codigo correspondiente................ todo
        //se verifica la base de datos........................ todo
        //se verifica la cache................................ todo
        //se verifica el contenido del modelo................. todo
    }

    public function testItCanShowCarousel():void
    {
        //usando la factory se crea y captura un carousel.... todo
        //como admin se solicita la ruta..................... todo
        //se evalua el codigo corespondiente de respuesta.... todo
        //se verifica que los datos traidos sean correctos... todo
        //se verifica la cahce............................... todo
        //se verifica que renderice correctamente............ todo

    }

    public function testItCanEditCarousel():void
    {
        //crea un carousel cusando factory................... todo
        //consume la ruta como admin......................... todo
        //revisa que este renderizado correctamente.......... todo
        //revisa que exista el boton submit.................. todo
    }
    public function TestItCanUpdateCarousel():void
    {
        //crea un carousel usando factory..................... todo
        //consume la ruta como admin.......................... todo
        //revisa el codigo de respuesta....................... todo
        //revisa que los datos cambiaron en base de datos..... todo
        //revisa que no exista cache.......................... todo
    }

    public function testItCanDestroyCarousel():void
    {
        //crea un carousel usando factoyr..................... todo
        //consume la ruta como admin.......................... todo
        //revisa el codigo de respuesta....................... todo
        //revisa que la base de datos este bacia.............. todo
        //revisa que no halla cache........................... todo
    }
}
