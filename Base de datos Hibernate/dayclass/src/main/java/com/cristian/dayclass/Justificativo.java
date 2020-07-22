/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cristian.dayclass;

import java.io.Serializable;
import java.sql.Blob;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;

/**
 *
 * @author Cristian
 */
@Entity
@Table(name="Justificativo", schema="dayclass")
public class Justificativo implements Serializable {
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private boolean aprobado;
    private String comentarioJustificativo;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaPresentacion;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaRevision;
    private Blob imagenJustificativo;
    
    @ManyToOne
    private Alumno alumno;

    public Justificativo() {
    }

    public int getId() {
        return id;
    }

    public boolean isAprobado() {
        return aprobado;
    }

    public void setAprobado(boolean aprobado) {
        this.aprobado = aprobado;
    }

    public Date getFechaRevision() {
        return fechaRevision;
    }

    public void setFechaRevision(Date fechaRevision) {
        this.fechaRevision = fechaRevision;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getComentarioJustificativo() {
        return comentarioJustificativo;
    }

    public void setComentarioJustificativo(String comentarioJustificativo) {
        this.comentarioJustificativo = comentarioJustificativo;
    }

    public Date getFechaPresentacion() {
        return fechaPresentacion;
    }

    public void setFechaPresentacion(Date fechaPresentacion) {
        this.fechaPresentacion = fechaPresentacion;
    }

    public Blob getImagenJustificativo() {
        return imagenJustificativo;
    }

    public void setImagenJustificativo(Blob imagenJustificativo) {
        this.imagenJustificativo = imagenJustificativo;
    }

    public Alumno getAlumno() {
        return alumno;
    }

    public void setAlumno(Alumno alumno) {
        this.alumno = alumno;
    }
    
}
