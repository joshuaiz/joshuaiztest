/*
*   JavaScript interface for the SoundCloud Player widget
*   Author: Matas Petrikas, matas@soundcloud.com
*   Copyright (c) 2009  SoundCloud Ltd.
*   Licensed under the MIT license:
*   http://www.opensource.org/licenses/mit-license.php
*/(function() {
    var e = /msie/i.test(navigator.userAgent) && !/opera/i.test(navigator.userAgent), t = window.soundcloud = {
        version: "0.1",
        debug: !1,
        _listeners: [],
        _redispatch: function(e, t, n) {
            var r, i = this._listeners[e] || [], s = "soundcloud:" + e;
            try {
                r = this.getPlayer(t);
            } catch (o) {
                this.debug && window.console && console.error("unable to dispatch widget event " + e + " for the widget id " + t, n, o);
                return;
            }
            window.jQuery ? jQuery(r).trigger(s, [ n ]) : window.Prototype && $(r).fire(s, n);
            for (var u = 0, a = i.length; u < a; u += 1) i[u].apply(r, [ r, n ]);
            this.debug && window.console && console.log(s, e, t, n);
        },
        addEventListener: function(e, t) {
            this._listeners[e] || (this._listeners[e] = []);
            this._listeners[e].push(t);
        },
        removeEventListener: function(e, t) {
            var n = this._listeners[e] || [];
            for (var r = 0, i = n.length; r < i; r += 1) n[r] === t && n.splice(r, 1);
        },
        getPlayer: function(t) {
            var n;
            try {
                if (!t) throw "The SoundCloud Widget DOM object needs an id atribute, please refer to SoundCloud Widget API documentation.";
                n = e ? window[t] : document[t];
                if (n) {
                    if (n.api_getFlashId) return n;
                    throw "The SoundCloud Widget External Interface is not accessible. Check that allowscriptaccess is set to 'always' in embed code";
                }
                throw "The SoundCloud Widget with an id " + t + " couldn't be found";
            } catch (r) {
                console && console.error && console.error(r);
                throw r;
            }
        },
        onPlayerReady: function(e, t) {
            this._redispatch("onPlayerReady", e, t);
        },
        onMediaStart: function(e, t) {
            this._redispatch("onMediaStart", e, t);
        },
        onMediaEnd: function(e, t) {
            this._redispatch("onMediaEnd", e, t);
        },
        onMediaPlay: function(e, t) {
            this._redispatch("onMediaPlay", e, t);
        },
        onMediaPause: function(e, t) {
            this._redispatch("onMediaPause", e, t);
        },
        onMediaBuffering: function(e, t) {
            this._redispatch("onMediaBuffering", e, t);
        },
        onMediaSeek: function(e, t) {
            this._redispatch("onMediaSeek", e, t);
        },
        onMediaDoneBuffering: function(e, t) {
            this._redispatch("onMediaDoneBuffering", e, t);
        },
        onPlayerError: function(e, t) {
            this._redispatch("onPlayerError", e, t);
        }
    };
})();

(function(e) {
    var t = function(e) {
        var t = function(e) {
            return {
                h: Math.floor(e / 36e5),
                m: Math.floor(e / 6e4 % 60),
                s: Math.floor(e / 1e3 % 60)
            };
        }(e), n = [];
        t.h > 0 && n.push(t.h);
        n.push(t.m < 10 && t.h > 0 ? "0" + t.m : t.m);
        n.push(t.s < 10 ? "0" + t.s : t.s);
        return n.join(".");
    }, n = function(e) {
        e.sort(function() {
            return 1 - Math.floor(Math.random() * 3);
        });
        return e;
    }, r = !0, i = !1, s = e(document), o = function(e) {
        try {
            r && window.console && window.console.log && window.console.log.apply(window.console, arguments);
        } catch (t) {}
    }, u = i ? "sandbox-soundcloud.com" : "soundcloud.com", a = document.location.protocol === "https:", f = function(e, t) {
        var n = (a || /^https/i.test(e) ? "https" : "http") + "://api." + u + "/resolve?url=", r = "format=json&consumer_key=" + t + "&callback=?";
        a && (e = e.replace(/^http:/, "https:"));
        return /api\./.test(e) ? e + "?" + r : n + e + "&" + r;
    }, l = function() {
        var t = function() {
            var e = !1;
            try {
                var t = new Audio;
                e = t.canPlayType && /maybe|probably/.test(t.canPlayType("audio/mpeg"));
            } catch (n) {}
            return e;
        }(), n = {
            onReady: function() {
                s.trigger("scPlayer:onAudioReady");
            },
            onPlay: function() {
                s.trigger("scPlayer:onMediaPlay");
            },
            onPause: function() {
                s.trigger("scPlayer:onMediaPause");
            },
            onEnd: function() {
                s.trigger("scPlayer:onMediaEnd");
            },
            onBuffer: function(e) {
                s.trigger({
                    type: "scPlayer:onMediaBuffering",
                    percent: e
                });
            }
        }, r = function() {
            var t = new Audio, r = function(e) {
                var t = e.target, r = (t.buffered.length && t.buffered.end(0)) / t.duration * 100;
                n.onBuffer(r);
                t.currentTime === t.duration && n.onEnd();
            }, i = function(e) {
                var t = e.target, r = (t.buffered.length && t.buffered.end(0)) / t.duration * 100;
                n.onBuffer(r);
            };
            e('<div class="sc-player-engine-container"></div>').appendTo(document.body).append(t);
            t.addEventListener("play", n.onPlay, !1);
            t.addEventListener("pause", n.onPause, !1);
            t.addEventListener("timeupdate", r, !1);
            t.addEventListener("progress", i, !1);
            return {
                load: function(e, n) {
                    t.pause();
                    t.src = e.stream_url + (/\?/.test(e.stream_url) ? "&" : "?") + "consumer_key=" + n;
                    t.load();
                    t.play();
                },
                play: function() {
                    t.play();
                },
                pause: function() {
                    t.pause();
                },
                stop: function() {
                    if (t.currentTime) {
                        t.currentTime = 0;
                        t.pause();
                    }
                },
                seek: function(e) {
                    t.currentTime = t.duration * e;
                    t.play();
                },
                getDuration: function() {
                    return t.duration * 1e3;
                },
                getPosition: function() {
                    return t.currentTime * 1e3;
                },
                setVolume: function(e) {
                    t.volume = e / 100;
                }
            };
        }, i = function() {
            var t = "scPlayerEngine", r, i = function(n) {
                var r = (a ? "https" : "http") + "://player." + u + "/player.swf?url=" + n + "&amp;enable_api=true&amp;player_type=engine&amp;object_id=" + t;
                return e.browser.msie ? '<object height="100%" width="100%" id="' + t + '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="' + r + '">' + '<param name="movie" value="' + r + '" />' + '<param name="allowscriptaccess" value="always" />' + "</object>" : '<object height="100%" width="100%" id="' + t + '">' + '<embed allowscriptaccess="always" height="100%" width="100%" src="' + r + '" type="application/x-shockwave-flash" name="' + t + '" />' + "</object>";
            };
            soundcloud.addEventListener("onPlayerReady", function(e, i) {
                r = soundcloud.getPlayer(t);
                n.onReady();
            });
            soundcloud.addEventListener("onMediaEnd", n.onEnd);
            soundcloud.addEventListener("onMediaBuffering", function(e, t) {
                n.onBuffer(t.percent);
            });
            soundcloud.addEventListener("onMediaPlay", n.onPlay);
            soundcloud.addEventListener("onMediaPause", n.onPause);
            return {
                load: function(t) {
                    var n = t.uri;
                    r ? r.api_load(n) : e('<div class="sc-player-engine-container"></div>').appendTo(document.body).html(i(n));
                },
                play: function() {
                    r && r.api_play();
                },
                pause: function() {
                    r && r.api_pause();
                },
                stop: function() {
                    r && r.api_stop();
                },
                seek: function(e) {
                    r && r.api_seekTo(r.api_getTrackDuration() * e);
                },
                getDuration: function() {
                    return r && r.api_getTrackDuration && r.api_getTrackDuration() * 1e3;
                },
                getPosition: function() {
                    return r && r.api_getTrackPosition && r.api_getTrackPosition() * 1e3;
                },
                setVolume: function(e) {
                    r && r.api_setVolume && r.api_setVolume(e);
                }
            };
        };
        return t ? r() : i();
    }(), c, h = !1, p = [], d = {}, v, m = function(t, n, r) {
        var i = 0, s = {
            node: t,
            tracks: []
        }, o = function(t) {
            var r = f(t.url, c);
            e.getJSON(r, function(u) {
                i += 1;
                if (u.tracks) s.tracks = s.tracks.concat(u.tracks); else if (u.duration) {
                    u.permalink_url = t.url;
                    s.tracks.push(u);
                } else u.creator ? n.push({
                    url: u.uri + "/tracks"
                }) : u.username ? /favorites/.test(t.url) ? n.push({
                    url: u.uri + "/favorites"
                }) : n.push({
                    url: u.uri + "/tracks"
                }) : e.isArray(u) && (s.tracks = s.tracks.concat(u));
                n[i] ? o(n[i]) : s.node.trigger({
                    type: "onTrackDataLoaded",
                    playerObj: s,
                    url: r
                });
            });
        };
        c = r;
        p.push(s);
        o(n[i]);
    }, g = function(e, t) {
        return t ? '<div class="sc-loading-artwork">Loading Artwork</div>' : e.artwork_url ? '<img src="' + e.artwork_url.replace("-large", "-t300x300") + '"/>' : '<div class="sc-no-artwork">No Artwork</div>';
    }, y = function(n, r) {
        e(".sc-info", n).each(function(t) {
            e("h3", this).html('<a href="' + r.permalink_url + '">' + r.title + "</a>");
            e("h4", this).html('by <a href="' + r.user.permalink_url + '">' + r.user.username + "</a>");
            e("p", this).html(r.description || "no Description");
        });
        e(".sc-artwork-list li", n).each(function(t) {
            var n = e(this), i = n.data("sc-track");
            i === r ? n.addClass("active").find(".sc-loading-artwork").each(function(t) {
                e(this).removeClass("sc-loading-artwork").html(g(r, !1));
            }) : n.removeClass("active");
        });
        e(".sc-duration", n).html(t(r.duration));
        e(".sc-waveform-container", n).html('<img src="' + r.waveform_url + '" />');
        n.trigger("onPlayerTrackSwitch.scPlayer", [ r ]);
    }, b = function(e) {
        var t = e.permalink_url;
        if (v === t) l.play(); else {
            v = t;
            l.load(e, c);
        }
    }, w = function(t) {
        return p[e(t).data("sc-player").id];
    }, E = function(t, n) {
        n && e("div.sc-player.playing").removeClass("playing");
        e(t).toggleClass("playing", n).trigger(n ? "onPlayerPlay" : "onPlayerPause");
    }, S = function(t, n) {
        var r = w(t).tracks[n || 0];
        y(t, r);
        d = {
            $buffer: e(".sc-buffer", t),
            $played: e(".sc-played", t),
            position: e(".sc-position", t)[0]
        };
        E(t, !0);
        b(r);
    }, x = function(e) {
        E(e, !1);
        l.pause();
    }, T = function() {
        var e = d.$played.closest(".sc-player"), n;
        d.$played.css("width", "0%");
        d.position.innerHTML = t(0);
        E(e, !1);
        l.stop();
        e.trigger("onPlayerTrackFinish");
    }, N = function(t, n) {
        l.seek(n);
        e(t).trigger("onPlayerSeek");
    }, C = function(t) {
        var n = e(t);
        o("track finished get the next one");
        $nextItem = e(".sc-trackslist li.active", n).next("li");
        $nextItem.length || ($nextItem = n.nextAll("div.sc-player:first").find(".sc-trackslist li.active"));
        $nextItem.click();
    }, k = function() {
        var e = 80, t = document.cookie.split(";"), n = new RegExp("scPlayer_volume=(\\d+)");
        for (var r in t) if (n.test(t[r])) {
            e = parseInt(t[r].match(n)[1], 10);
            break;
        }
        return e;
    }(), L = function(e) {
        var t = Math.floor(e), n = new Date;
        n.setTime(n.getTime() + 31536e6);
        k = t;
        document.cookie = [ "scPlayer_volume=", t, "; expires=", n.toUTCString(), '; path="/"' ].join("");
        l.setVolume(k);
    }, A;
    s.bind("scPlayer:onAudioReady", function(e) {
        o("onPlayerReady: audio engine is ready");
        l.play();
        L(k);
    }).bind("scPlayer:onMediaPlay", function(e) {
        clearInterval(A);
        A = setInterval(function() {
            var e = l.getDuration(), n = l.getPosition(), r = n / e;
            d.$played.css("width", 100 * r + "%");
            d.position.innerHTML = t(n);
            s.trigger({
                type: "onMediaTimeUpdate.scPlayer",
                duration: e,
                position: n,
                relative: r
            });
        }, 500);
    }).bind("scPlayer:onMediaPause", function(e) {
        clearInterval(A);
        A = null;
    }).bind("scPlayer:onVolumeChange", function(e) {
        L(e.volume);
    }).bind("scPlayer:onMediaEnd", function(e) {
        T();
    }).bind("scPlayer:onMediaBuffering", function(e) {
        d.$buffer.css("width", e.percent + "%");
    });
    e.scPlayer = function(r, i) {
        var s = e.extend({}, e.scPlayer.defaults, r), o = p.length, u = i && e(i), a = u[0].className.replace("sc-player", ""), f = s.links || e.map(e("a", u).add(u.filter("a")), function(e) {
            return {
                url: e.href,
                title: e.innerHTML
            };
        }), l = e('<div class="sc-player loading"></div>').data("sc-player", {
            id: o
        }), c = e('<ol class="sc-artwork-list"></ol>').appendTo(l), d = e('<div class="sc-info"><h3></h3><h4></h4><p></p><a href="#" class="sc-info-close">X</a></div>').appendTo(l), v = e('<div class="sc-controls"></div>').appendTo(l), b = e('<ol class="sc-trackslist"></ol>').appendTo(l);
        (a || s.customClass) && l.addClass(a).addClass(s.customClass);
        l.find(".sc-controls").append('<a href="#play" class="sc-play">Play</a> <a href="#pause" class="sc-pause hidden">Pause</a>').end().append('<a href="#info" class="sc-info-toggle">Info</a>').append('<div class="sc-scrubber"></div>').find(".sc-scrubber").append('<div class="sc-volume-slider"><span class="sc-volume-status" style="width:' + k + '%"></span></div>').append('<div class="sc-time-span"><div class="sc-waveform-container"></div><div class="sc-buffer"></div><div class="sc-played"></div></div>').append('<div class="sc-time-indicators"><span class="sc-position"></span> | <span class="sc-duration"></span></div>');
        m(l, f, s.apiKey);
        l.bind("onTrackDataLoaded.scPlayer", function(r) {
            var i = r.playerObj.tracks;
            s.randomize && (i = n(i));
            e.each(i, function(n, r) {
                var i = n === 0;
                e('<li><a href="' + r.permalink_url + '">' + r.title + '</a><span class="sc-track-duration">' + t(r.duration) + "</span></li>").data("sc-track", {
                    id: n
                }).toggleClass("active", i).appendTo(b);
                e("<li></li>").append(g(r, n >= s.loadArtworks)).appendTo(c).toggleClass("active", i).data("sc-track", r);
            });
            l.each(function() {
                e.isFunction(s.beforeRender) && s.beforeRender.call(this, i);
            });
            e(".sc-duration", l)[0].innerHTML = t(i[0].duration);
            e(".sc-position", l)[0].innerHTML = t(0);
            y(l, i[0]);
            s.continuePlayback && l.bind("onPlayerTrackFinish", function(e) {
                C(l);
            });
            l.removeClass("loading").trigger("onPlayerInit");
            if (s.autoPlay && !h) {
                S(l);
                h = !0;
            }
        });
        u.each(function(t) {
            e(this).replaceWith(l);
        });
        return l;
    };
    e.scPlayer.stopAll = function() {
        e(".sc-player.playing a.sc-pause").click();
    };
    e.scPlayer.destroy = function() {
        e(".sc-player, .sc-player-engine-container").remove();
    };
    e.fn.scPlayer = function(t) {
        h = !1;
        this.each(function() {
            e.scPlayer(t, this);
        });
        return this;
    };
    e.scPlayer.defaults = e.fn.scPlayer.defaults = {
        customClass: null,
        beforeRender: function(t) {
            var n = e(this);
        },
        onDomReady: function() {
            e("a.sc-player, div.sc-player").scPlayer();
        },
        autoPlay: !1,
        continuePlayback: !0,
        randomize: !1,
        loadArtworks: 5,
        apiKey: "htuiRd1JP11Ww0X72T1C3g"
    };
    e(document).on("click", "a.sc-play, a.sc-pause", function(t) {
        var n = e(this).closest(".sc-player").find("ol.sc-trackslist");
        n.find("li.active").click();
        return !1;
    });
    e(document).on("click", "a.sc-info-toggle, a.sc-info-close", function(t) {
        var n = e(this);
        n.closest(".sc-player").find(".sc-info").toggleClass("active").end().find("a.sc-info-toggle").toggleClass("active");
        return !1;
    });
    e(document).on("click", ".sc-trackslist li", function(t) {
        var n = e(this), r = n.closest(".sc-player"), i = n.data("sc-track").id, s = r.is(":not(.playing)") || n.is(":not(.active)");
        s ? S(r, i) : x(r);
        n.addClass("active").siblings("li").removeClass("active");
        e(".artworks li", r).each(function(t) {
            e(this).toggleClass("active", t === i);
        });
        return !1;
    });
    var O = function(t, n) {
        var r = e(t).closest(".sc-time-span"), i = r.find(".sc-buffer"), s = r.find(".sc-waveform-container img"), o = r.closest(".sc-player"), u = Math.min(i.width(), n - s.offset().left) / s.width();
        N(o, u);
    }, M = function(e) {
        if (e.targetTouches.length === 1) {
            O(e.target, e.targetTouches && e.targetTouches.length && e.targetTouches[0].clientX);
            e.preventDefault();
        }
    };
    e(document).on("click", ".sc-time-span", function(e) {
        O(this, e.pageX);
        return !1;
    }).on("touchstart", ".sc-time-span", function(e) {
        this.addEventListener("touchmove", M, !1);
        e.originalEvent.preventDefault();
    }).on("touchend", ".sc-time-span", function(e) {
        this.removeEventListener("touchmove", M, !1);
        e.originalEvent.preventDefault();
    });
    var _ = function(t, n) {
        var r = e(t), i = r.offset().left, o = r.width(), u = function(e) {
            return Math.floor((e - i) / o * 100);
        }, a = function(e) {
            s.trigger({
                type: "scPlayer:onVolumeChange",
                volume: u(e.pageX)
            });
        };
        r.bind("mousemove.sc-player", a);
        a(n);
    }, D = function(t, n) {
        e(t).unbind("mousemove.sc-player");
    };
    e(document).on("mousedown", ".sc-volume-slider", function(e) {
        _(this, e);
    }).on("mouseup", ".sc-volume-slider", function(e) {
        D(this, e);
    });
    s.bind("scPlayer:onVolumeChange", function(t) {
        e("span.sc-volume-status").css({
            width: t.volume + "%"
        });
    });
    e(function() {
        e.isFunction(e.scPlayer.defaults.onDomReady) && e.scPlayer.defaults.onDomReady();
    });
})(jQuery);