
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Link Analytics
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- URL Information -->
                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 10px;">
                        {{ $shortUrl->short_code }}
                    </h3>

                    <p style="overflow-wrap: anywhere; margin-bottom: 12px;">
                        Original URL: {{ $shortUrl->original_url }}
                    </p>

                    <a href="{{ route('dashboard') }}"
                       style="color: #2563eb; text-decoration: underline;">
                        Back to Dashboard
                    </a>
                </div>

                <!-- Daily Clicks -->
                <div style="margin-bottom: 35px;">
                    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">
                        Daily Clicks
                    </h3>

                    <div style="width: 100%; overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="border-bottom: 2px solid #ddd;">
                                    <th style="padding: 12px; text-align: left;">Date</th>
                                    <th style="padding: 12px; text-align: left;">Total Clicks</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($dailyClicks as $click)
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <td style="padding: 12px;">{{ $click->date }}</td>
                                        <td style="padding: 12px;">{{ $click->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="padding: 12px;">
                                            No clicks recorded yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Top Referrers -->
                <div style="margin-bottom: 35px;">
                    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">
                        Top Referrers
                    </h3>

                    <div style="width: 100%; overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="border-bottom: 2px solid #ddd;">
                                    <th style="padding: 12px; text-align: left;">Referrer</th>
                                    <th style="padding: 12px; text-align: left;">Total Clicks</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($topReferrers as $referrer)
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <td style="padding: 12px; overflow-wrap: anywhere;">
                                            {{ $referrer->ref ?? 'Direct / Unknown' }}
                                        </td>
                                        <td style="padding: 12px;">{{ $referrer->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="padding: 12px;">
                                            No referrer data available yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Clicks -->
                <div>
                    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">
                        Recent Clicks
                    </h3>

                    <div style="width: 100%; overflow-x: auto;">
                        <table style="width: 100%; min-width: 650px; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="border-bottom: 2px solid #ddd;">
                                    <th style="padding: 12px; text-align: left;">Timestamp</th>
                                    <th style="padding: 12px; text-align: left;">Browser / Device</th>
                                    <th style="padding: 12px; text-align: left;">Referrer</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($recentClicks as $click)
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <td style="padding: 12px; white-space: nowrap;">
                                            {{ $click->clicked_at }}
                                        </td>

                                        <td style="padding: 12px; overflow-wrap: anywhere;">
                                            {{ $click->user_agent }}
                                        </td>

                                        <td style="padding: 12px; overflow-wrap: anywhere;">
                                            {{ $click->referer ?? 'Direct / Unknown' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" style="padding: 12px;">
                                            No recent clicks available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
