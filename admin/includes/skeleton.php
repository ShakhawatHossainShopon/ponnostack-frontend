<!-- GLOBAL TAB CONTENT SKELETON (SHIMMER LOADER) -->
<div id="tabContentSkeleton" class="space-y-6">
    
    <!-- 1. Header Card Skeleton -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="space-y-2.5 w-full max-w-md">
                <div class="h-4 w-28 rounded-full skeleton-shimmer"></div>
                <div class="h-7 w-64 rounded-xl skeleton-shimmer"></div>
                <div class="h-3.5 w-full rounded-lg skeleton-shimmer"></div>
            </div>
            <div class="flex space-x-2">
                <div class="h-9 w-28 rounded-xl skeleton-shimmer"></div>
                <div class="h-9 w-24 rounded-xl skeleton-shimmer"></div>
            </div>
        </div>
    </div>

    <!-- 2. Metric / Stats Cards Skeleton (4 Cards) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <?php for ($i = 0; $i < 4; $i++): ?>
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-xs space-y-3">
            <div class="flex items-center justify-between">
                <div class="h-3 w-16 rounded-md skeleton-shimmer"></div>
                <div class="w-6 h-6 rounded-lg skeleton-shimmer"></div>
            </div>
            <div class="h-8 w-24 rounded-xl skeleton-shimmer"></div>
            <div class="h-2.5 w-20 rounded-md skeleton-shimmer"></div>
        </div>
        <?php endfor; ?>
    </div>

    <!-- 3. Table / Card List Skeleton -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div class="h-4 w-36 rounded-lg skeleton-shimmer"></div>
            <div class="h-8 w-44 rounded-xl skeleton-shimmer"></div>
        </div>

        <div class="space-y-3">
            <?php for ($i = 0; $i < 5; $i++): ?>
            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl skeleton-shimmer shrink-0"></div>
                    <div class="space-y-1.5">
                        <div class="h-3.5 w-36 rounded-md skeleton-shimmer"></div>
                        <div class="h-2.5 w-24 rounded-md skeleton-shimmer"></div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="h-6 w-16 rounded-full skeleton-shimmer"></div>
                    <div class="h-8 w-20 rounded-xl skeleton-shimmer"></div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
