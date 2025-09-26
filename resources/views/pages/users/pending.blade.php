<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-2 sm:p-4 md:p-6">
    <div x-data="{ pageName: `Aprovação de novos usuários` }" class="px-3 py-2">
        @include('layouts.partials.base.breadcrumb')
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-white/[0.03]">


    @if (!$users->count() > 0)
        <h3 class="text-base font-medium text-emerald-600 dark:emerald-red-400 mb-2 sm:mb-0 ml-6 py-6">
            ✅ Não há pendências para aprovar
        </h3>
    @else
        <h3 class="text-base font-medium text-red-600 dark:text-red-400 mb-2 sm:mb-0 ml-6 py-6">
            ⏳ Usuários aguardando aprovação ({{ $users->count() }})
        </h3>
    
        
        <div class="border-t border-gray-100 p-4 sm:p-5 dark:border-gray-700">
            <x-alert-success></x-alert-success>
            <div x-data="dataTable()"
                class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-700 dark:bg-white/[0.03]">

                <div class="mb-4 flex flex-col gap-4 px-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-gray-500 dark:text-gray-400 text-sm">Mostrar</span>
                        <select x-model.number="perPage"
                            class="dark:bg-dark-900 h-9 w-full rounded-lg border border-gray-300 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 min-w-[70px]">
                            <option class="text-center" value="9">9</option>
                            <option class="text-center" value="18">18</option>
                            <option class="text-center" value="50">50</option>
                        </select>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">registros</span>
                    </div>

                    <div class="relative w-full sm:w-auto">
                        <input type="text" x-model="search" placeholder="Pesquisar..."
                            class="dark:bg-dark-900 h-10 w-full rounded-lg border border-gray-300 py-2.5 pl-3 pr-4 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-[900px] lg:min-w-full"> 

                        <div class="grid grid-cols-10 border-t border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-600">
                            
                            <div class="col-span-2 flex justify-between items-center border-r border-gray-200 px-4 py-3 dark:border-gray-700 cursor-pointer"
                                @click="sortBy('firstname')">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400">Nome</p>
                                <span class="flex flex-col gap-0.5 ml-2">
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z" fill=""></path>
                                    </svg>
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z" fill=""></path>
                                    </svg>
                                </span>
                            </div>

                            <div class="col-span-2 flex justify-between items-center border-r border-gray-200 px-4 py-3 dark:border-gray-700 cursor-pointer"
                                @click="sortBy('lastname')">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400">Sobrenome</p>
                                <span class="flex flex-col gap-0.5 ml-2">
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z" fill=""></path>
                                    </svg>
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z" fill=""></path>
                                    </svg>
                                </span>
                            </div>

                            <div class="col-span-2 flex justify-between items-center border-r border-gray-200 px-4 py-3 dark:border-gray-700 cursor-pointer"
                                @click="sortBy('phone')">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400">Celular</p>
                                <span class="flex flex-col gap-0.5 ml-2">
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z" fill=""></path>
                                    </svg>
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z" fill=""></path>
                                    </svg>
                                </span>
                            </div>

                            <div class="col-span-2 flex justify-between items-center border-r border-gray-200 px-4 py-3 dark:border-gray-700 cursor-pointer"
                                @click="sortBy('email')">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400">E-mail</p>
                                <span class="flex flex-col gap-0.5 ml-2">
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z" fill=""></path>
                                    </svg>
                                    <svg class="fill-gray-600 dark:fill-gray-200 w-2 h-2" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z" fill=""></path>
                                    </svg>
                                </span>
                            </div>

                            <div class="col-span-1 flex items-center justify-center border-r border-gray-200 px-4 py-3 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400">Grupo</p>
                            </div>
                            
                            <div class="col-span-1 flex items-center justify-center px-4 py-3">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400">Ações</p>
                            </div>

                        </div>

                        <template x-for="person in paginatedData" :key="person.id">
                            <div class="grid grid-cols-10 border-t border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                
                                <div class="col-span-2 flex items-center px-4 py-3">
                                    <span class="text-theme-xs block font-xs text-gray-800 dark:text-white/90 truncate" x-text="person.firstname"></span>
                                </div>

                                <div class="col-span-2 flex items-center px-4 py-3">
                                    <span x-text="person.lastname" class="text-theme-xs block font-xs text-gray-800 dark:text-white/90 truncate"></span>
                                </div>

                                <div class="col-span-2 flex items-center px-4 py-3">
                                    <span x-text="person.phone" class="text-theme-xs block font-xs text-gray-800 dark:text-white/90 truncate"></span>
                                </div>

                                <div class="col-span-2 flex items-center px-4 py-3">
                                    <span x-text="person.email" class="text-theme-xs block font-xs text-gray-800 dark:text-white/90 truncate"></span>
                                </div>

                                <div class="col-span-1 flex items-center justify-center px-4 py-3">
                                    <span
                                        x-text="person.role || 'PENDENTE'" 
                                        :class="person.role ? 'text-gray-800 dark:text-white/90' : 'text-xs text-red-700 bg-amber-200 rounded-lg px-2 py-0.5 font-bold'"
                                        class="text-theme-xs block font-xs whitespace-nowrap"
                                    >
                                    </span>
                                </div>
                                
                                <div class="col-span-1 flex items-center justify-center px-4 py-3">
                                    <a 
                                        :href="`{{ route('users.edit', ':id') }}`.replace(':id', person.id)"
                                        class="p-1 text-sm font-medium text-cyan-600 hover:text-cyan-900 dark:text-gray-300 dark:hover:text-cyan-300 flex items-center justify-center"
                                        aria-label="Editar Usuário"
                                    >
                                        <svg class="fill-current w-5 h-5" viewBox="0 0 21 21"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z"
                                                fill=""></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>

                <div class="border-t border-gray-200 py-4 px-3 dark:border-slate-800">
                    <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Mostrando <span class="font-bold" x-text="startEntry"></span> a <span class="font-bold"
                                x-text="endEntry"></span> de <span class="font-bold" x-text="totalEntries"></span>
                            registros
                        </p>

                        <div class="flex items-center gap-2">
                            <button @click="prevPage()" :disabled="currentPage === 1"
                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-800 dark:text-gray-300 dark:hover:bg-slate-700 dark:focus:ring-offset-slate-900"
                                aria-label="Página Anterior">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 md:size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                                </svg>
                                <span class="ml-1 hidden sm:block">Anterior</span>
                            </button>

                            <template x-for="page in pagesAroundCurrent" :key="page">
                                <button @click="goToPage(page)"
                                    :class="{
                                        'bg-blue-600 text-white shadow-md': currentPage === page,
                                        'text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-gray-300 dark:bg-slate-700 dark:hover:bg-slate-600': currentPage !== page
                                    }"
                                    class="hidden h-9 w-9 items-center justify-center rounded-full text-sm font-medium transition-colors sm:flex"
                                    x-text="page"></button>
                            </template>

                            <button @click="nextPage()" :disabled="currentPage === totalPages"
                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-800 dark:text-gray-300 dark:hover:bg-slate-700 dark:focus:ring-offset-slate-900"
                                aria-label="Próxima Página">
                                <span class="mr-1 hidden sm:block">Próximo</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 md:size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

    <!-- Alpine.js DataTable -->
    <script>
        function dataTable() {
            return {
                search: "",
                sortColumn: "firstname",
                sortDirection: "asc",
                currentPage: 1,
                perPage: 9, // default inicial igual ao select
                data: @json($usersJson),

                get filteredData() {
                    const searchLower = this.search.toLowerCase();
                    return this.data.filter(person =>
                        person.firstname.toLowerCase().includes(searchLower) ||
                        person.lastname.toLowerCase().includes(searchLower) ||
                        person.phone.toLowerCase().includes(searchLower) ||
                        person.role.toLowerCase().includes(searchLower) ||
                        person.email.toLowerCase().includes(searchLower)

                    ).sort((a, b) => {
                        let modifier = this.sortDirection === "asc" ? 1 : -1;
                        if (a[this.sortColumn] < b[this.sortColumn]) return -1 * modifier;
                        if (a[this.sortColumn] > b[this.sortColumn]) return 1 * modifier;
                        return 0;
                    });
                },

                get paginatedData() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredData.slice(start, end);
                },

                get totalEntries() {
                    return this.filteredData.length;
                },

                get startEntry() {
                    return this.totalEntries === 0 ? 0 : (this.currentPage - 1) * this.perPage + 1;
                },

                get endEntry() {
                    const end = this.currentPage * this.perPage;
                    return end > this.totalEntries ? this.totalEntries : end;
                },

                get totalPages() {
                    return Math.ceil(this.totalEntries / this.perPage);
                },

                get pagesAroundCurrent() {
                    let pages = [];
                    const startPage = Math.max(1, this.currentPage - 2);
                    const endPage = Math.min(this.totalPages, this.currentPage + 2);
                    for (let i = startPage; i <= endPage; i++) pages.push(i);
                    return pages;
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.currentPage = page;
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) this.currentPage++;
                },
                prevPage() {
                    if (this.currentPage > 1) this.currentPage--;
                },

                sortBy(column) {
                    if (this.sortColumn === column) {
                        this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
                    } else {
                        this.sortColumn = column;
                        this.sortDirection = "asc";
                    }
                }
            }
        }
    </script>
</x-app-layout>
