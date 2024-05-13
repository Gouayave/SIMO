import cv2, numpy, requests

X = 357
Y = 235
max_circle = 0

class Dt:

    def Detect_tir(channel = 0):

        cam = cv2.VideoCapture(channel)
        focus =  False
        tir_x = None
        tir_y = None
        session = ""

        while True:
            _, frame = cam.read()

            img_gris = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
            _, utile = cv2.threshold(img_gris, 240, 255, cv2.THRESH_BINARY)
            contours, _ = cv2.findContours(utile, cv2.RETR_TREE, cv2.CHAIN_APPROX_NONE)
            center_x, center_y = False, False



            lst = []

            for contour in contours:
                aprx = cv2.approxPolyDP(contour, 0.01 * cv2.arcLength(contour, True), True)
                if len(aprx) == 4:
                    pass
                else:
                    M, rayon = cv2.moments(contour), numpy.sqrt(cv2.contourArea(contour) / numpy.pi)
                    if M['m00'] != 0:
                        center_x, center_y = int(M['m10'] / M['m00']), int(M['m01'] / M['m00'])

                        lst.append([center_x, center_y])
                        cv2.circle(frame, (center_x, center_y), round(rayon*1.5), (0, 255, 0) , -1)

            for x in range(6):
                max_circle = ((x+1)*2)*21
                cv2.circle(frame, (X, Y), max_circle , (255, 0, 0) , 2)

            if len(lst) > 0 and not focus:
                tir_x = int((center_x - X ) * 100 / max_circle)
                tir_y = int((center_y - Y ) * 100 / max_circle)
                print(f'tir : ({tir_x, tir_y})')
                response = requests.get('http://localhost/SIMO/recordCoordinates.php',params = {"x": tir_x , "y":tir_y})
                print(response.status_code)
                if response.status_code == 200 :
                    session = response.content.decode().split(',')[0]
                    print(session)

            if len(lst) > 0:
                focus =  True
            else:
                focus = False

            cv2.putText(frame,
                '> ' + session + ' | tir : ('+str(tir_x)+','+ str(tir_y) +')',
                (50, 50),
                cv2.FONT_HERSHEY_SIMPLEX, 1,
                (0, 255, 255),
                2,
                cv2.LINE_4)

            cv2.imshow('frame', frame)
            cv2.waitKey(1)

rtn = Dt.Detect_tir(channel = 0)
print(rtn)
