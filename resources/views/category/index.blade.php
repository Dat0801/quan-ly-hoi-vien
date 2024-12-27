<x-app-layout>
    <div class="d-flex align-items-start">
        <!-- Main Content -->
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <h1 id="dynamicTitle" style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Danh sách ngành
            </h1>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
                <li class="nav-item">
                    <a class="nav-link active" id="industry-tab" data-bs-toggle="tab" href="#industry" role="tab" aria-controls="industry" aria-selected="true" style="color: #803B03;">Ngành</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="fields-tab" data-bs-toggle="tab" href="#fields" role="tab" aria-controls="fields" aria-selected="false" style="color: #803B03;">Lĩnh vực</a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="industry" role="tabpanel" aria-labelledby="industry-tab">
                    <!-- Nội dung ngành sẽ được load từ Ajax -->
                </div>

                <div class="tab-pane fade" id="fields" role="tabpanel" aria-labelledby="fields-tab">
                    <!-- Nội dung lĩnh vực sẽ được load từ Ajax -->
                </div>
            </div>
        </div>

        <!-- Add New Button (Will be toggled based on tab) -->
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('industry.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addIndustryButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm ngành</span>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleElement = document.getElementById('dynamicTitle');
            const tabLinks = document.querySelectorAll('.nav-link');
            const addIndustryButton = document.getElementById('addIndustryButton');
            const addNewButtonContainer = document.getElementById('addNewButtonContainer');

            // Cập nhật tiêu đề và button khi chuyển qua tab
            tabLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const tabId = this.getAttribute('aria-controls');

                    switch (tabId) {
                        case 'industry':
                            titleElement.textContent = 'Danh sách ngành';
                            addIndustryButton.innerHTML = '<i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i><span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm ngành</span>';
                            addIndustryButton.setAttribute('href', '{{ route('industry.create') }}');
                            addNewButtonContainer.style.display = 'flex';
                            loadPartial('industry');
                            break;
                        case 'fields':
                            titleElement.textContent = 'Danh sách lĩnh vực';
                            addIndustryButton.innerHTML = '<i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i><span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm lĩnh vực</span>';
                            addIndustryButton.setAttribute('href', '{{ route('field.create') }}');
                            addNewButtonContainer.style.display = 'flex';
                            loadPartial('fields');
                            break;
                    }
                });
            });

            loadPartial('industry');

            function loadPartial(tab, url = '') {
                // If no URL is provided, use the default URL for the tab
                if (!url) {
                    if (tab === 'industry') {
                        url = '{{ route('category.industries') }}';
                    } else if (tab === 'fields') {
                        url = '{{ route('category.fields') }}';
                    }
                }

                // Perform an AJAX GET request to fetch new content for the tab
                $.get(url, function(data) {
                    // Replace the content of the tab with the new data
                    $('#' + tab).html(data);

                    // Unbind previous click event handler for pagination links
                    $(document).off('click', '.pagination a');

                    // Re-bind pagination links
                    $(document).on('click', '.pagination a', function(event) {
                        event.preventDefault();
                        var newUrl = $(this).attr('href'); // Get the URL for the new page
                        loadPartial(tab, newUrl);  // Reload the content for the new page
                    });
                });
            }
        });

    </script>
</x-app-layout>
