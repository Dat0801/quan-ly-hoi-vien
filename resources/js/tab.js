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

    function loadPartial(tab) {
        let url = '';
        if (tab === 'industry') {
            url = '{{ route('category.industries') }}';
        } else if (tab === 'fields') {
            url = '{{ route('category.fields') }}';
        }

        $.get(url, function(data) {
            $('#' + tab).html(data);  // Cập nhật nội dung tab
        });
    }

    // Hàm load khi người dùng chuyển trang
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var tab = $('#managementTabs .nav-link.active').attr('aria-controls');
        loadPartial(tab, url);  // Gọi lại hàm loadPartial cho trang mới
    });
});