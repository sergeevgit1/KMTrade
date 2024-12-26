document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.querySelector(".search-input");
  const searchResults = document.createElement("div");
  searchResults.className =
    "absolute w-full bg-white mt-1 rounded-lg shadow-lg border border-gray-200 z-50 hidden";
  searchInput.parentNode.appendChild(searchResults);

  let searchTimeout;

  searchInput.addEventListener("input", function () {
    clearTimeout(searchTimeout);
    const query = this.value;

    if (query.length < 3) {
      searchResults.classList.add("hidden");
      return;
    }

    searchTimeout = setTimeout(() => {
      fetch(ajax_object.ajax_url, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "crane_parts_search",
          nonce: ajax_object.nonce,
          query: query,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            displayResults(data.data);
          }
        });
    }, 300);
  });

  function displayResults(results) {
    if (!results.length) {
      searchResults.innerHTML =
        '<div class="p-4 text-gray-500">Ничего не найдено</div>';
      searchResults.classList.remove("hidden");
      return;
    }

    const html = results
      .map((result) => {
        let icon = "";
        switch (result.type) {
          case "page":
            icon =
              '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>';
            break;
          case "part":
            icon =
              '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>';
            break;
          case "category":
            icon =
              '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>';
            break;
          case "crane":
            icon =
              '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            break;
        }

        return `
                <a href="${result.url}" class="flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 transition-colors">
                    <div class="text-gray-400">${icon}</div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">${result.title}</div>
                        <div class="text-sm text-gray-500">${result.type_label}</div>
                    </div>
                </a>
            `;
      })
      .join("");

    searchResults.innerHTML = html;
    searchResults.classList.remove("hidden");
  }

  // Закрытие результатов при клике вне
  document.addEventListener("click", function (e) {
    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
      searchResults.classList.add("hidden");
    }
  });
});
