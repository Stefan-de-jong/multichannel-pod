#!/usr/bin/env python
# coding: utf-8

# imports
import os
import glob
import cv2
import numpy as np
from tensorflow import keras
from matplotlib import pyplot as plt
import shutil

# constants and variables
IMAGE_SIZE = 224
image_dir = "D:\\dev\\multichannel-app\\storage\\app\\images"
input_folder = "crops"
output_folder = "output"
originals_folder = "originals\\step2"
move_folder = "originals\\step3"

models_dir = "D:\\dev\\multichannel-app\\app\\Scripts\\models"
model_version = "v6"
#my_model = "D:\\dev\\multichannel-app\\app\\Scripts\\models\\tcr_detection_model_v6.h5"
my_model = models_dir + '/' + 'tcr_detection_model_' + model_version + '.h5'

# image_dir = "D:\\dev\\multichannel-app\\storage\\app\\images"
# input_folder = "step1"

# the directory for all the training images, version 3
# v1 was original size, v2 was cropped, v3 was cropped and with added padding in annotations
data_path = os.path.join(image_dir + '/' + input_folder,'*g')
files = glob.glob(data_path)


# files are read, resized and stored in the list
X=[]
for f1 in files:
    img = cv2.imread(f1)
    img = cv2.resize(img, (IMAGE_SIZE,IMAGE_SIZE))
    X.append(np.array(img))


# filenames are store so the original name can be used when writing to disk later
filenames = []
for i, filename in enumerate(os.listdir(image_dir + '/' + input_folder)):
    filenames.append(filename)


X=np.array(X)
X = X / 255


# model version6 scored yielded some pretty good results, so we are loading this in
model = keras.models.load_model(my_model)


# using the model to detect the TCR numbers
y_cnn = model.predict(X)


plt.figure(figsize=(20,40))
for i in range(0,len(X)) :
    plt.subplot(10,5,i+1)
    plt.axis('off')
    ny = y_cnn[i]*255

#     # this draws the bounding box on the image as a green line
#     # commented out, since we only want to crop the bounding box
#     image = cv2.rectangle(X[i],(int(ny[0]),int(ny[1])),(int(ny[2]),int(ny[3])),(0, 255, 0))

    # the coordinates of the detected/predicted TCR number
    start_y = int(ny[3])
    end_y = int(ny[1])
    start_x = int(ny[2])
    end_x = int(ny[0])

    # this crops out the detected TCR and save it as a new image to in with OCR
    cropped_tcr = X[i][start_y:end_y, start_x:end_x]
    filename = image_dir + '/' + output_folder + '/' + filenames[i]
    cv2.imwrite(filename, cropped_tcr*255)

#     cv2.imshow('TCR', cropped_tcr)
#     cv2.waitKey(0)
    os.remove(image_dir + '/' + input_folder + '/' + filenames[i])
    shutil.move(image_dir + '/' + originals_folder + '/' + filenames[i], image_dir + '/' + move_folder + '/' + filenames[i])
exit()
