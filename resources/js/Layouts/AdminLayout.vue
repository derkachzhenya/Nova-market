<template>

    <section class="w-full p-4 border-b border-gray-100">
        <header>
            Market Admin
        </header>
    </section>

    <section class="flex">

        <aside class="w-1/4 bg-gray-100 min-h-screen">
            <nav>
            <Link :href="route('admin.dashboard')" class="block p-4 border-b border-gray-300">Дашборд</Link>
            <Link :href="route('admin.product-parents.index')" class="block p-4 border-b border-gray-300">Гупа продуктов </Link>
            <Link :href="route('admin.products.index')" class="block p-4 border-b border-gray-300">Продукты</Link>
            <Link :href="route('admin.categories.index')" class="block p-4 border-b border-gray-300">Категории</Link>
            <Link :href="route('admin.params.index')" class="block p-4 border-b border-gray-300">Характеристики</Link>
            </nav>
        </aside>

        <article class="w-3/4 bg-gray-50">
            <slot />
        </article> 

    </section>

    <section>
        <footer>

        </footer>
    </section>

</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: 'AdminLayout' ,

    components: {
         Link
    }
}
</script>

<style scoped></style>
