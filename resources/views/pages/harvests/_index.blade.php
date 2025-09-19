<x-app-layout>

  <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">


  <div x-data="{ pageName: `Basic Tables`}">
    @include('layouts.partials.breadcrumb')
  </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
  <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
        Recent Orders
      </h3>
    </div>

    <div class="flex items-center gap-3">
      <button
        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
      >
        <svg
          class="stroke-current fill-white dark:fill-gray-800"
          width="20"
          height="20"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M2.29004 5.90393H17.7067"
            stroke=""
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M17.7075 14.0961H2.29085"
            stroke=""
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M12.0826 3.33331C13.5024 3.33331 14.6534 4.48431 14.6534 5.90414C14.6534 7.32398 13.5024 8.47498 12.0826 8.47498C10.6627 8.47498 9.51172 7.32398 9.51172 5.90415C9.51172 4.48432 10.6627 3.33331 12.0826 3.33331Z"
            fill=""
            stroke=""
            stroke-width="1.5"
          />
          <path
            d="M7.91745 11.525C6.49762 11.525 5.34662 12.676 5.34662 14.0959C5.34661 15.5157 6.49762 16.6667 7.91745 16.6667C9.33728 16.6667 10.4883 15.5157 10.4883 14.0959C10.4883 12.676 9.33728 11.525 7.91745 11.525Z"
            fill=""
            stroke=""
            stroke-width="1.5"
          />
        </svg>

        Filter
      </button>

      <button
        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
      >
        See all
      </button>
    </div>
  </div>

  <div class="w-full overflow-x-auto">

    <table class="min-w-full">
      <thead>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th class="px-5 py-3 text-left w-1/16 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Código</p>
          </th>
          <th class="px-5 py-3 text-left w-3/16 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nome</p>
          </th>
          <th class="px-5 py-3 text-left w-3/16 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Cidade/UF</p>
          </th>
          <th class="px-5 py-3 text-left w-3/16 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
          </th>
          <th class="px-5 py-3 text-left w-3/16 sm:px-6">
            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Ações</p>
          </th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($harvests as $harvest)
        <tr class="border-t border-gray-100 dark:border-gray-800">
            <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $harvest->id }}</p>
            </td>
            <td class="px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div>
                        <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                            {{ $harvest->title }}
                        </span>
                        <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                            {{ $harvest->description }}
                        </span>
                    </div>
                </div>
            </td>
            <td class="px-3 py-2 sm:px-3">
            {{-- <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ (port?.city) }}/{{ (port?.state) }}</p> --}}
            </td>
            <td class="px-3 py-2 sm:px-3">
            <Badge v-if="port?.status === true" color="success" variant="solid">
                sim
            </Badge>
            <Badge v-else color="warning" variant="solid">
                nao
            </Badge>
            </td>
            <td class="px-5 py-4 sm:px-6">
                <div class="flex items-center w-full gap-2">
                    <button data-v-f8e13455="" class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">
                        <router-link :to="`/port/edit/${port?.id}`">  
                        <Edit />
                        </router-link>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>


</x-app-layout>
