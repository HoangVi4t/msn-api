<?php

namespace App\Services;

use ImageIntervention;

class ImageService
{
    public function updateImage($model, $request, $path, $methodType)
    {
        $image = ImageIntervention::make($request->file('image')); // lấy hình ảnh và tạo ra từ image imageInvention

        if (!empty($model->image)) { // nếu ảnh ko bị null
            $currentImage = public_path() . $path . $model->image; // thì dẫn đến path thuộc tính image model

            if (file_exists($currentImage)) { // check xem nếu trùng ảnh
                unlink($currentImage); // xóa
            }
        }

        $file = $request->file('image'); //lấy ảnh
        $extension = $file->getClientOriginalExtension(); //lấy phần mở rộng của tệp (ví dụ: jpg, png, gif,...)

        $image->crop(
            $request->width,
            $request->height,
            $request->left,
            $request->top
        );

        $name = time() . '.' . $extension; // lấy thời gian hiện tại dưới dạng số giây tính từ 1/1/1970 + (jpg, png, gif,)
        $image->save(public_path() . $path . $name); // lưu hình ảnh mới vào đường dẫn được cung cấp

        if ($methodType === 'store') { // nếu method = store (lưu)
            $model->user_id = $request->get('user_id'); // tạo thêm bản ghi mới
        }

        $model->image = $name; // nếu ko phải thì save

        $model->save();
    }
}
