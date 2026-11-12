<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            URL Shortener Dashboard
        </h2>
    </x-slot>

    <div class="mb-6 flex justify-end">
        <a href="{{ route('home') }}"
        style="background-color: #2563eb; color: white; padding: 12px 20px; border-radius: 8px; font-weight: 600; display: inline-block; text-decoration: none;">
            + Create New Short Link
        </a>
    </div>

    <div class="py-12">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Total Links -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-500">Total Links</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $totalLinks }}
                        </h3>
                    </div>

                    <!-- Total Clicks -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-500">Total Clicks</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $totalClicks }}
                        </h3>
                    </div>

                    <!-- Active Links -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-500">Active Links</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $activeLinks }}
                        </h3>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg mt-8 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                My Shortened URLs
                            </h3>

                            <div style="width: 100%; overflow-x: auto;">
                                <table style="width: 100%; min-width: 750px; border-collapse: collapse; text-align: left;">

                                    <thead>
                                        <tr style="border-bottom: 2px solid #ddd;">
                                            <th style="padding: 12px;">Original URL</th>
                                            <th style="padding: 12px;">Short URL</th>
                                            <th style="padding: 12px;">Clicks</th>
                                            <th style="padding: 12px;">Status</th>
                                            <th style="padding: 12px;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($urls as $url)
                                            <tr style="border-bottom: 1px solid #ddd;">

                                                <td style="padding: 12px; max-width: 220px; overflow-wrap: anywhere;">
                                                    {{ $url->original_url }}
                                                </td>

                                                <td style="padding: 12px; overflow-wrap: anywhere;">
                                                    <a href="{{ route('short-urls.redirect', $url->short_code) }}"
                                                    target="_blank"
                                                    style="color: #2563eb; text-decoration: underline;">
                                                        {{ url('/s/' . $url->short_code) }}
                                                    </a>
                                                </td>

                                                <td style="padding: 12px;">
                                                    {{ $url->clicks_count }}
                                                </td>

                                                <td style="padding: 12px; white-space: nowrap;">
                                                    @if ($url->expires_at && $url->expires_at->isPast())
                                                        Expired
                                                    @elseif (!$url->is_active)
                                                        Inactive
                                                    @else
                                                        Active
                                                    @endif
                                                </td>

                                                <td style="padding: 12px;">
                                                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">

                                                        <a href="{{ route('short-urls.analytics', $url) }}"
                                                        style="color: #2563eb; text-decoration: underline;">
                                                            Analytics
                                                        </a>

                                                        <form action="{{ route('short-urls.toggle', $url) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <button type="submit"
                                                                    style="color: #16a34a; background: none; border: none; cursor: pointer;">
                                                                {{ $url->is_active ? 'Deactivate' : 'Activate' }}
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('short-urls.destroy', $url) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this link?')">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    style="color: #dc2626; background: none; border: none; cursor: pointer;">
                                                                Delete
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" style="padding: 20px;">
                                                    You haven't created any short links yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                            <div style="margin-top: 20px;">
                                {{ $urls->links() }}
                            </div>

                            <div class="mt-6">
                                {{ $urls->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
