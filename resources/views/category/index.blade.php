<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <h1 id="dynamicTitle" style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Danh sách ngành
            </h1>

            <ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist" style="border-bottom: 2px solid #FFE3CD;">
                <li class="nav-item">
                    <a class="nav-link active" id="industry-tab" data-bs-toggle="tab" href="#industry" role="tab" aria-controls="industry" aria-selected="true" style="color: #803B03;">Ngành</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="fields-tab" data-bs-toggle="tab" href="#fields" role="tab" aria-controls="fields" aria-selected="false" style="color: #803B03;">Lĩnh vực</a>
                </li>
            </ul>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="industry" role="tabpanel" aria-labelledby="industry-tab">
                    <!-- Nội dung ngành sẽ được load từ Ajax -->
                </div>

                <div class="tab-pane fade" id="fields" role="tabpanel" aria-labelledby="fields-tab">
                    <!-- Nội dung lĩnh vực sẽ được load từ Ajax -->
                </div>
            </div>
        </div>

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

            const currentTab = new URLSearchParams(window.location.search).get('tab') || 'industry';  

            tabLinks.forEach(link => {
                const tabId = link.getAttribute('aria-controls');

                if (tabId === currentTab) {
                    link.classList.add('active'); 
                    switchTab(tabId);  
                } else {
                    link.classList.remove('active'); 
                }

                link.addEventListener('click', function() {
                    const tabId = this.getAttribute('aria-controls');
                    window.history.pushState(null, '', '?tab=' + tabId);
                    switchTab(tabId);
                });
            });

            function switchTab(tabId) {
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
            }

            loadPartial(currentTab);

            function loadPartial(tab, url = '') {
                if (!url) {
                    if (tab === 'industry') {
                        url = '{{ route('category.industries') }}';
                    } else if (tab === 'fields') {
                        url = '{{ route('category.fields') }}';
                    }
                }

                const search = getSearchParam(tab); 

                $.get(url, { search: search }, function (data) {
                    $('#' + tab).html(data);
                    $('#' + tab).addClass('show active'); 

                    if (tab === 'industry') {
                        $('#industrySearchForm input[name="search_industry"]').val(search); 
                    } else if (tab === 'fields') {
                        $('#fieldSearchForm input[name="search_fields"]').val(search); 
                    }


                    $(document).off('click', '.pagination a');
                    $(document).on('click', '.pagination a', function (event) {
                        event.preventDefault();
                        let newUrl = $(this).attr('href');
                        loadPartial(tab, newUrl);
                    });
                });
            }

            function getSearchParam(tab) {
                const urlParams = new URLSearchParams(window.location.search);
                if (tab === 'industry') {
                    return urlParams.get('search_industry') || ''; 
                } else if (tab === 'fields') {
                    return urlParams.get('search_fields') || '';
                }
                return '';
            }

            $(document).ready(function () {
                $('#industrySearchForm').submit(function (e) {
                    e.preventDefault(); 
                    const search = $('#industrySearchForm input[name="search_industry"]').val(); 
                    const newUrl = '{{ route('category.industries') }}' + '?tab=' + currentTab + '&search_industry=' + search;
                    window.history.pushState(null, '', newUrl); 
                    loadPartial('industry', newUrl);
                });

                $('#fieldSearchForm').submit(function (e) {
                    e.preventDefault(); 
                    const search = $('#fieldSearchForm input[name="search_fields"]').val(); 
                    const newUrl = '{{ route('category.fields') }}' + '?tab=' + currentTab + '&search_fields=' + search;  
                    window.history.pushState(null, '', newUrl);  
                    loadPartial('fields', newUrl); 
                });
            });
        });

    </script>
</x-app-layout>
