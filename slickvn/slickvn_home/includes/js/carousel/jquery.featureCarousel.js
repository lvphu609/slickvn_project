/*!
 * Feature Carousel, Version 1.3
 * http://www.bkosolutions.com
 *
 * Copyright 2011 Brian Osborne
 * Licensed under GPL version 3
 * brian@bkosborne.com
 *
 * http://www.gnu.org/licenses/gpl.txt
 */
/*!
 * Feature Carousel, Version 1.3
 * http://www.bkosolutions.com
 *
 * Copyright 2011 Brian Osborne
 * Licensed under GPL version 3
 * brian@bkosborne.com
 *
 * http://www.gnu.org/licenses/gpl.txt
 */
(function (a) {
    a.fn.featureCarousel = function (f) {
        if (this.length > 1) {
            this.each(function () {
                a(this).featureCarousel(f)
            });
            return this
        }
        f = a.extend({}, a.fn.featureCarousel.defaults, f || {});
        var q = {
            currentCenterNum: f.startingFeature,
            containerWidth: 0,
            containerHeight: 0,
            largeFeatureWidth: 0,
            largeFeatureHeight: 0,
            smallFeatureWidth: 0,
            smallFeatureHeight: 0,
            totalFeatureCount: a(this).children("div").length,
            currentlyMoving: false,
            featuresContainer: a(this),
            featuresArray: [],
            containerIDTag: "#" + a(this).attr("id"),
            timeoutVar: null,
            rotationsRemaining: 0,
            itemsToAnimate: 0,
            borderWidth: 0
        };
        var j = function (w) {
            if (f.preload == true) {
                var u = q.featuresContainer.find("img");
                var t = 0;
                var v = u.length;
                u.each(function (y, z) {
                    var x = new Image();
                    a(x).bind("load error", function () {
                        t++;
                        if (t == v) {
                            w()
                        }
                    });
                    x.src = z.src
                })
            } else {
                w()
            }
        };
        var m = function (t) {
            return q.featuresArray[t - 1]
        };
        var n = function (t) {
            a.each(q.featuresArray, function () {
                if (a(this).data().setPosition == t) {
                    return a(this)
                }
            })
        };
        var c = function (t) {
            if ((t - 1) == 0) {
                return q.totalFeatureCount
            } else {
                return t - 1
            }
        };
        var i = function (t) {
            if ((t + 1) > q.totalFeatureCount) {
                return 1
            } else {
                return t + 1
            }
        };
        var e = function () {
            q.containerWidth = q.featuresContainer.width();
            q.containerHeight = q.featuresContainer.height();
            var t = a(q.containerIDTag).find(".carousel-image:first");
            if (f.largeFeatureWidth > 1) {
                q.largeFeatureWidth = f.largeFeatureWidth
            } else {
                if (f.largeFeatureWidth > 0 && f.largeFeatureWidth < 1) {
                    q.largeFeatureWidth = t.width() * f.largeFeatureWidth
                } else {
                    q.largeFeatureWidth = t.outerWidth()
                }
            } if (f.largeFeatureHeight > 1) {
                q.largeFeatureHeight = f.largeFeatureHeight
            } else {
                if (f.largeFeatureHeight > 0 && f.largeFeatureHeight < 1) {
                    q.largeFeatureHeight = t.height() * f.largeFeatureHeight
                } else {
                    q.largeFeatureHeight = t.outerHeight()
                }
            } 
            
            if (f.smallFeatureWidth > 1) {
                q.smallFeatureWidth = f.smallFeatureWidth
            } else {
                if (f.smallFeatureWidth > 0 && f.smallFeatureWidth < 1) {
                    q.smallFeatureWidth = t.width() * f.smallFeatureWidth
                } else {
                    q.smallFeatureWidth = t.outerWidth()/2;
                }
            } 
            
            if (f.smallFeatureHeight > 1) {
                q.smallFeatureHeight = 100;//f.smallFeatureHeight
            } else {
                if (f.smallFeatureHeight > 0 && f.smallFeatureHeight < 1) {
                    q.smallFeatureHeight = t.height() * f.smallFeatureHeight
                } else {
                    q.smallFeatureHeight = t.outerHeight() / 2;
                }
            }
        };
        var b = function () {
            if (f.displayCutoff > 0 && f.displayCutoff < q.totalFeatureCount) {
                q.totalFeatureCount = f.displayCutoff
            }
            q.featuresContainer.find(".carousel-feature").each(function (t) {
                if (t < q.totalFeatureCount) {
                    q.featuresArray[t] = a(this)
                }
            });
            if (q.featuresContainer.find(".carousel-feature").first().css("borderLeftWidth") != "medium") {
                q.borderWidth = parseInt(q.featuresContainer.find(".carousel-feature").first().css("borderLeftWidth")) * 2
            }
            q.featuresContainer.find(".carousel-feature").each(function () {
                a(this).css({
                    left: (q.containerWidth / 2) - (q.smallFeatureWidth / 2) - (q.borderWidth / 2),
                    width: q.smallFeatureWidth,
                    height: q.smallFeatureHeight,
                    top: f.smallFeatureOffset + f.topPadding,
                    opacity: 0
                })
            }).find(".carousel-image").css({
                width: q.smallFeatureWidth
            });
            if (f.captionBelow) {
                q.featuresContainer.find(".carousel-caption").css("position", "relative")
            }
            if (q.totalFeatureCount < 4) {
                q.itemsToAnimate = q.totalFeatureCount
            } else {
                q.itemsToAnimate = 4
            }
            q.featuresContainer.find(".carousel-caption").hide()
        };
        var r = function () {
            a.each(q.featuresArray, function (x) {
                a(this).data("setPosition", x + 1)
            });
            var w = c(f.startingFeature);
            q.currentCenterNum = w;
            var v = m(w);
            v.data("position", 1);
            var u = v.prevAll();
            u.each(function (x) {
                a(this).data("position", (q.totalFeatureCount - x))
            });
            var t = v.nextAll();
            t.each(function (x) {
                if (a(this).data("setPosition") != undefined) {
                    a(this).data("position", (x + 2))
                }
            });
            if (f.counterStyle == "caption") {
                a.each(q.featuresArray, function () {
                    var y = c(a(this).data("position"));
                    var x = a("<span></span>");
                    x.addClass("numberTag");
                    x.html("(" + y + " of " + q.totalFeatureCount + ") ");
                    a(this).find(".carousel-caption p").prepend(x)
                })
            }
        };
        var h = function () {
            if (f.trackerIndividual) {
                var z = a("<ul></ul>");
                z.addClass("tracker-individual-container");
                for (var y = 0; y < q.totalFeatureCount; y++) {
                    var t = y + 1;
                    var x = a("<div>&nbsp</div>");
                    x.addClass("tracker-individual-blip");
                    x.css("cursor", "pointer");
                    x.attr("id", "tracker-" + (y + 1));
                    var w = a("<li></li>");
                    w.append(x);
                    w.css("float", "left");
                    w.css("list-style-type", "none");
                    z.append(w)
                }
                a(q.containerIDTag).append(z);
                z.hide().show()
            }
            if (f.trackerSummation) {
                var v = a("<div></div>");
                v.addClass("tracker-summation-container");
                var u = a("<span></span>").addClass("tracker-summation-current").text(f.startingFeature);
                var B = a("<span></span>").addClass("tracker-summation-total").text(q.totalFeatureCount);
                var A = a("<span></span>").addClass("tracker-summation-middle").text(" of ");
                v.append(u).append(A).append(B);
                a(q.containerIDTag).append(v)
            }
        };
        var s = function (x, t) {
            if (f.trackerIndividual) {
                var u = q.featuresContainer.find(".tracker-individual-container");
                var v = u.find("#tracker-" + x);
                var w = u.find("#tracker-" + t);
                v.removeClass("tracker-individual-blip-selected");
                w.addClass("tracker-individual-blip-selected")
            }
            if (f.trackerSummation) {
                var u = q.featuresContainer.find(".tracker-summation-container");
                u.find(".tracker-summation-current").text(t)
            }
        };
        var p = function (u) {
            clearTimeout(q.timeoutVar);
            if (!u && f.autoPlay != 0) {
                var t = (Math.abs(f.autoPlay) < f.carouselSpeed) ? f.carouselSpeed : Math.abs(f.autoPlay);
                q.timeoutVar = setTimeout(function () {
                    (f.autoPlay > 0) ? k(true, 1) : k(false, 1)
                }, t)
            }
        };
        var d = function (t) {
            a.each(q.featuresArray, function () {
                var u;
                if (t == false) {
                    u = i(a(this).data().position)
                } else {
                    u = c(a(this).data().position)
                }
                a(this).data("position", u)
            })
        };
        var o = function (y, C) {
            var w, t, v, z, u, D, A;
            var B = y.data("position");
            var x;
            if (C == true) {
                x = c(B)
            } else {
                x = i(B)
            } if (B == 1) {
                f.leavingCenter(y)
            }
            if (x == 1) {
                w = q.largeFeatureWidth;
                t = q.largeFeatureHeight;
                v = f.topPadding;
                u = y.css("z-index");
                z = (q.containerWidth / 2) - (q.largeFeatureWidth / 2) - (q.borderWidth / 2);
                A = 1
            } else {
                w = q.smallFeatureWidth;
                t = q.smallFeatureHeight;
                v = f.smallFeatureOffset + f.topPadding;
                u = 1;
                A = 0.4;
                if (x == q.totalFeatureCount) {
                    z = f.sidePadding
                } else {
                    if (x == 2) {
                        z = q.containerWidth - q.smallFeatureWidth - f.sidePadding - q.borderWidth
                    } else {
                        z = (q.containerWidth / 2) - (q.smallFeatureWidth / 2) - (q.borderWidth / 2);
                        A = 0
                    }
                }
            } if (B == 1) {
                y.find(".carousel-caption").hide()
            }
            y.animate({
                width: w,
                height: t,
                top: v,
                left: z,
                opacity: A
            }, f.carouselSpeed, f.animationEasing, function () {
                if (x == 1) {
                    if (f.captionBelow) {
                        y.css("height", "auto")
                    }
                    y.find(".carousel-caption").fadeTo("fast", 0.45);
                    f.movedToCenter(y)
                }
                q.rotationsRemaining = q.rotationsRemaining - 1;
                y.css("z-index", u);
                if (f.trackerIndividual || f.trackerSummation) {
                    if (x == 1) {
                        var E = q.featuresContainer.find(".carousel-feature").index(y) + 1;
                        var F;
                        if (C == false) {
                            F = i(E)
                        } else {
                            F = c(E)
                        }
                        s(F, E)
                    }
                }
                var G = q.rotationsRemaining / q.itemsToAnimate;
                if (G % 1 == 0) {
                    q.currentlyMoving = false;
                    d(C);
                    if (q.rotationsRemaining > 0) {
                        l(C)
                    }
                }
                p(false)
            }).find(".carousel-image").animate({
                width: w,
                height: t
            }, f.carouselSpeed, f.animationEasing).end()
        };
        var l = function (w) {
            q.currentlyMoving = true;
            var x, v, t, u;
            if (w == true) {
                x = m(i(q.currentCenterNum));
                v = m(q.currentCenterNum);
                t = m(i(i(q.currentCenterNum)));
                u = m(c(q.currentCenterNum));
                q.currentCenterNum = i(q.currentCenterNum)
            } else {
                x = m(c(q.currentCenterNum));
                v = m(c(c(q.currentCenterNum)));
                t = m(q.currentCenterNum);
                u = m(i(q.currentCenterNum));
                q.currentCenterNum = c(q.currentCenterNum)
            } if (w) {
                v.css("z-index", 3)
            } else {
                t.css("z-index", 3)
            }
            x.css("z-index", 4);
            o(v, w);
            o(x, w);
            o(t, w);
            if (q.totalFeatureCount > 3) {
                o(u, w)
            }
        };
        var k = function (v, u) {
            if (q.currentlyMoving == false) {
                var t = u * q.itemsToAnimate;
                q.rotationsRemaining = t;
                l(v)
            }
        };
        var g = function (x, w) {
            var u = 1,
                t = 1,
                v;
            v = x;
            while ((v = c(v)) != w) {
                u++
            }
            v = x;
            while ((v = i(v)) != w) {
                t++
            }
            return (u < t) ? u * -1 : t
        };
        a(f.leftButtonTag).live("click", function () {
            k(false, 1)
        });
        a(f.rightButtonTag).live("click", function () {
            k(true, 1)
        });
        q.featuresContainer.find(".carousel-feature").click(function () {
            var t = a(this).data("position");
            if (t == 2) {
                k(true, 1)
            } else {
                if (t == q.totalFeatureCount) {
                    k(false, 1)
                }
            }
        }).mouseover(function () {
            if (q.currentlyMoving == false) {
                var t = a(this).data("position");
                if (t == 2 || t == q.totalFeatureCount) {
                    a(this).css("opacity", 0.8)
                }
            }
            if (f.pauseOnHover) {
                p(true)
            }
            if (f.stopOnHover) {
                f.autoPlay = 0
            }
        }).mouseout(function () {
            if (q.currentlyMoving == false) {
                var t = a(this).data("position");
                if (t == 2 || t == q.totalFeatureCount) {
                    a(this).css("opacity", 0.4)
                }
            }
            if (f.pauseOnHover) {
                p(false)
            }
        });
        a("a", q.containerIDTag).live("click", function (u) {
            var t = a(this).parentsUntil(q.containerIDTag);
            t.each(function () {
                var v = a(this).data("position");
                if (v != undefined) {
                    if (v != 1) {
                        if (v == q.totalFeatureCount) {
                            k(false, 1)
                        } else {
                            if (v == 2) {
                                k(true, 1)
                            }
                        }
                        u.preventDefault();
                        return false
                    } else {
                        f.clickedCenter(a(this))
                    }
                }
            })
        });
        a(".tracker-individual-blip", q.containerIDTag).live("click", function () {
            var t = a(this).attr("id").substring(8);
            var v = q.featuresContainer.find(".carousel-feature").eq(t - 1).data("position");
            var u = q.currentCenterNum;
            if (t != u) {
                var w = g(1, v);
                if (w < 0) {
                    k(false, (w * -1))
                } else {
                    k(true, w)
                }
            }
        });
        this.initialize = function () {
            j(function () {
                e();
                b();
                r();
                h();
                k(true, 1)
            });
            return this
        };
        this.next = function () {
            k(true, 1)
        };
        this.prev = function () {
            k(false, 1)
        };
        this.pause = function () {
            p(true)
        };
        this.start = function () {
            p(false)
        };
        return this.initialize()
    };
    a.fn.featureCarousel.defaults = {
        largeFeatureWidth: 0,
        largeFeatureHeight: 0,
        smallFeatureWidth: 0.5,
        smallFeatureHeight: 0.5,
        topPadding: 20,
        sidePadding:0,
        smallFeatureOffset: 50,
        startingFeature: 1,
        carouselSpeed: 1000,
        autoPlay:3000,
        pauseOnHover: true,
        stopOnHover: false,
        trackerIndividual: true,
        trackerSummation: false,
        preload: true,
        displayCutoff: 0,
        animationEasing: "swing",
        leftButtonTag: "#carousel-left",
        rightButtonTag: "#carousel-right",
        captionBelow: false,
        movedToCenter: a.noop,
        leavingCenter: a.noop,
        clickedCenter: a.noop
    }
})(jQuery);