<header
    class="fixed left-0 top-0 flex h-screen w-72 flex-col border-r border-slate-200 bg-slate-950 text-slate-100 shadow-2xl">
    <div class="border-b border-slate-800 px-6 py-6">
        <div class="flex items-center gap-3">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 via-sky-500 to-blue-600 text-sm font-semibold text-white shadow-lg shadow-sky-950/30">
                AP
            </div>

            <div class="min-w-0">
                <p class="truncate text-base font-semibold tracking-tight text-white">Admin Panel</p>
                <p class="text-xs font-medium uppercase tracking-[0.24em] text-slate-400">Operations Hub</p>
            </div>
        </div>
    </div>

    <div class="flex-1 px-4 py-6">
        <p class="px-3 text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Navigation</p>

        <nav class="mt-4 flex flex-col gap-2 text-sm font-medium">
            <a href="{{ route('adminUsersPage') }}"
                class="{{ request()->is('admin/users*') ? 'bg-slate-800 text-white shadow-lg shadow-slate-950/20 ring-1 ring-inset ring-slate-700' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} group flex items-center justify-between rounded-2xl px-4 py-3 transition duration-200">
                <span>Users</span>
                <span class="text-xs text-slate-500 transition group-hover:text-slate-300">01</span>
            </a>

            <a href="{{ route('adminProductsPage') }}"
                class="{{ request()->is('admin/products*') ? 'bg-slate-800 text-white shadow-lg shadow-slate-950/20 ring-1 ring-inset ring-slate-700' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} group flex items-center justify-between rounded-2xl px-4 py-3 transition duration-200">
                <span>Products</span>
                <span class="text-xs text-slate-500 transition group-hover:text-slate-300">02</span>
            </a>

            <a href="{{ url('/admin/orders') }}"
                class="{{ request()->is('admin/orders*') ? 'bg-slate-800 text-white shadow-lg shadow-slate-950/20 ring-1 ring-inset ring-slate-700' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} group flex items-center justify-between rounded-2xl px-4 py-3 transition duration-200">
                <span>Orders</span>
                <span class="text-xs text-slate-500 transition group-hover:text-slate-300">03</span>
            </a>

            <a href="{{ route('adminSubmissionsPage') }}"
                class="{{ request()->is('admin/contacts*') ? 'bg-slate-800 text-white shadow-lg shadow-slate-950/20 ring-1 ring-inset ring-slate-700' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} group flex items-center justify-between rounded-2xl px-4 py-3 transition duration-200">
                <span>Contact Submissions</span>
                <span class="text-xs text-slate-500 transition group-hover:text-slate-300">04</span>
            </a>
            <a href="{{ route('homePage') }}"
                class="{{ false ? 'bg-slate-800 text-white shadow-lg shadow-slate-950/20 ring-1 ring-inset ring-slate-700' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} group flex items-center justify-between rounded-2xl px-4 py-3 transition duration-200">
                <span>Back to site</span>
                <span class="text-xs text-slate-500 transition group-hover:text-slate-300">05</span>
            </a>
        </nav>
    </div>

    <div class="border-t border-slate-800 px-6 py-4">
        <div class="rounded-2xl bg-slate-900 px-4 py-3 ring-1 ring-inset ring-slate-800">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Workspace</p>
            <p class="mt-1 text-sm font-medium text-slate-200">Manage store data with a focused admin navigation.</p>
        </div>
    </div>
</header>