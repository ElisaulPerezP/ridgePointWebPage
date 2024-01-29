<x-app-layout>
    <!-- ======= Hero Section ======= -->
    @slot('slotHead')
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle"
                    data-aos="fade-down">
                 <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carousels.index') }}">carousels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                    </ul>
                </div>
            </div>
        </section>
    @endslot
    @slot('slotMain')
    <section id="editResourceIndex">

</section>
    @endslot
</x-app-layout>

