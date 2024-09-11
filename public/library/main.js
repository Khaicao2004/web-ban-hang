document.addEventListener("DOMContentLoaded", function () {
    let variantIndex = 1;

    // Khởi tạo Select2 cho các trường select
    function initializeSelect2() {
        $(".select2").select2({
            allowClear: true,
        });
    }
    initializeSelect2();
    // Thêm biến thể mới
    document
        .getElementById("btn-add-variant")
        .addEventListener("click", function () {
            const variantsContainer =
                document.getElementById("variant-container");
            const newVariantRow = document.createElement("div");
            let attributeOptions = '<option value="">Chọn thuộc tính</option>';
            for (const [id, name] of Object.entries(attributes)) {
                attributeOptions += `<option value="${id}">${name}</option>`;
            }

            let attributeValueOptions =
                ' <option value="">Chọn giá trị</option>';
            for (const [id, name] of Object.entries(attributeValues)) {
                attributeValueOptions += `<option value="${id}">${name}</option>`;
            }
            newVariantRow.classList.add("row", "mb-3", "variant-row");
            newVariantRow.setAttribute("data-index", variantIndex);

            newVariantRow.innerHTML = `
            <div class="col-md-3">
                <label for="attribute_id" class="form-label">Thuộc tính</label>
                <select name="variants[${variantIndex}][attributes][]" class="form-select select2">
                   ${attributeOptions}
                </select>
            </div>

            <div class="col-md-2">
                <label for="attribute_value_id" class="form-label">Giá trị</label>
                <select name="variants[${variantIndex}][attribute_values][]" class="form-select select2">        
                    ${attributeValueOptions}
                </select>
            </div>
            
            <div class="col-md-2">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" name="variants[${variantIndex}][quantity]" class="form-control">
            </div>

            <div class="col-md-2">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="variants[${variantIndex}][price]" class="form-control">
            </div>
            
            <div class="col-md-2">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" name="variants[${variantIndex}][image]" class="form-control">
            </div>

            <div class="col-md-1 d-flex align-items-end mt-1">
                <button type="button" class="btn btn-danger btn-remove-variant">Xóa</button>
            </div>

            <div class="col-md-12 attributes-container mt-2">
                <!-- Thuộc tính mặc định sẽ được thêm vào đây -->
            </div>

             <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-add-attribute mt-2">Thêm thuộc tính</button>
            </div>
        `;
            variantsContainer.appendChild(newVariantRow);
            variantIndex++;
            // Khởi tạo Select2 cho các trường select mới
            initializeSelect2();
        });

    // Xóa biến thể
    document
        .getElementById("variant-container")
        .addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-remove-variant")) {
                e.target.closest(".variant-row").remove();
            }
        });

    // Thêm thuộc tính
    document
        .getElementById("variant-container")
        .addEventListener("click", function (e) {
            let attributeOptions = '<option value="">Chọn thuộc tính</option>';
            for (const [id, name] of Object.entries(attributes)) {
                attributeOptions += `<option value="${id}">${name}</option>`;
            }

            let attributeValueOptions =
                ' <option value="">Chọn giá trị</option>';
            for (const [id, name] of Object.entries(attributeValues)) {
                attributeValueOptions += `<option value="${id}">${name}</option>`;
            }
            if (e.target.classList.contains("btn-add-attribute")) {
                const variantRow = e.target.closest(".variant-row");
                const attributesContainer = variantRow.querySelector(
                    ".attributes-container"
                );
                const newAttributeGroup = document.createElement("div");
                newAttributeGroup.classList.add("row", "mb-2");
                newAttributeGroup.innerHTML = `
                <div class="col-md-3">
                    <select name="variants[${variantRow.getAttribute(
                        "data-index"
                    )}][attributes][]"
                            class="form-select select2">
                        ${attributeOptions}
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="variants[${variantRow.getAttribute(
                        "data-index"
                    )}][attribute_values][]"
                            class="form-select select2">
                        ${attributeValueOptions}
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-remove-attribute">Xóa thuộc tính</button>
                </div>
            `;
                attributesContainer.appendChild(newAttributeGroup);
                // Khởi tạo Select2 cho thuộc tính mới
                initializeSelect2();
            }
        });

    // Xóa thuộc tính
    document
        .getElementById("variant-container")
        .addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-remove-attribute")) {
                e.target.closest(".row").remove();
            }
        });
});

$(document).on('click', '.delete-gallery', function(){
    var galleryId = $(this).data('id');
    // Thêm input hidden để lưu ID của ảnh sẽ bị xóa
    $('form').append('<input type="hidden" name="delete_galleries[]" value="' + galleryId + '">');
    // Ẩn ảnh khỏi giao diện
    $('#gallery-' + galleryId).remove();
});