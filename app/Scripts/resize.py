#!/usr/bin/env python
# coding: utf-8

# imports
import os
import shutil
import cv2

# constants and variables
image_dir = "D:\\dev\\multichannel-app\\storage\\app\\images"
input_folder = "step1"
scale = 50 #percent
crop_size = 500 #pixels
write_folder = "crops"
write_prefix = "cropped_"
output_folder = "step2"

# go over all files in input_folder
for dirname in os.listdir(image_dir):
    for i, filename in enumerate(os.listdir(image_dir + '/' + input_folder)):

        # load the image
        img = cv2.imread(image_dir + '/' + input_folder + '/' + filename)

        # resize the image
        h, w, c = img.shape
        new_w = int(w * scale / 100)
        new_h = int(h * scale / 100)
        dimension = (new_w, new_h)
        resized_img = cv2.resize(img, dimension)

        # cropping the upper-right corner
        h, w, c = resized_img.shape
        y = 0
        x = w-crop_size
        new_h = crop_size
        new_w = crop_size
        crop = resized_img[y:y+new_h, x:x+new_w]

        # save cropped as new file for further processing
        cv2.imwrite(image_dir + '/' + write_folder + '/' + write_prefix + filename, crop)
        # move raw file to output_folder
        shutil.move(image_dir + '/' + input_folder + '/' + filename, image_dir + '/' + output_folder + '/' + filename)
    break
exit()

