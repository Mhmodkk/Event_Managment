<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                إدارة المستخدمين
            </h2>
            <a href="{{ route('managment') }}"
                class="px-5 py-2.5 bg-[#F7F8F0] dark:bg-[#393E46] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-xl text-sm font-medium transition flex items-center gap-2">
                ← العودة للوحة التحكم
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-sm sm:rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">

                <!-- شريط البحث -->
                <div class="p-6 border-b border-[#9CD5FF] dark:border-[#948979] bg-[#9CD5FF] dark:bg-[#222831]">
                    <form method="GET" class="flex max-w-lg">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="ابحث بالاسم أو البريد الإلكتروني..."
                            class="flex-1 rounded-l-2xl border border-[#9CD5FF] dark:border-[#948979] dark:bg-[#393E46] dark:text-[#DFD0B8] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] px-5 py-3 outline-none text-sm">
                        <button type="submit"
                            class="px-8 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-r-2xl font-medium transition flex items-center gap-2">
                            <span>بحث</span>
                        </button>
                    </form>
                </div>

                <!-- الجدول -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#9CD5FF] dark:divide-[#948979] text-right">
                        <thead class="bg-[#F7F8F0] dark:bg-[#393E46]">
                            <tr>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    الاسم</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    البريد الإلكتروني</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    الدور</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    تاريخ التسجيل</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider w-40">
                                    تغيير الدور</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#F7F8F0] dark:bg-[#393E46] divide-y divide-[#9CD5FF] dark:divide-[#948979]">
                            @forelse ($users as $user)
                                <tr class="hover:bg-[#9CD5FF] dark:hover:bg-[#948979]/50 transition-colors">
                                    <td
                                        class="px-6 py-5 whitespace-nowrap text-sm font-medium text-[#355872] dark:text-[#DFD0B8]">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-[#948979] dark:text-[#948979]">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                            {{ $user->isSuperAdmin()
                                                ? 'bg-[#9CD5FF] text-[#355872] border border-[#7AAACE]'
                                                : ($user->isAdmin()
                                                    ? 'bg-[#7AAACE] text-white border border-[#7AAACE]'
                                                    : 'bg-[#9CD5FF] text-[#355872] border border-[#7AAACE]') }}">
                                            {{ $user->isSuperAdmin() ? 'مدير' : ($user->isAdmin() ? 'مشرف' : 'طالب') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-[#948979] dark:text-[#948979]">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" onchange="this.form.submit()"
                                                class="text-sm border border-[#9CD5FF] dark:border-[#948979] dark:bg-[#393E46] dark:text-[#DFD0B8] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] bg-[#F7F8F0]">
                                                <option value="student"
                                                    {{ $user->role === 'student' ? 'selected' : '' }}>طالب</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                    مشرف</option>
                                                <option value="super_admin"
                                                    {{ $user->role === 'super_admin' ? 'selected' : '' }}> مدير
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-6xl mb-4 opacity-30">👥</span>
                                            <p class="text-lg text-[#948979] dark:text-[#948979]">لا يوجد مستخدمين
                                                مسجلين
                                                حاليًا</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-5 border-t border-[#9CD5FF] dark:border-[#948979] bg-[#9CD5FF] dark:bg-[#222831]">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
